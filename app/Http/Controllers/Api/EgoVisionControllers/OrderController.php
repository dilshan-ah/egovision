<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Order;
use App\Models\EgoModels\OrderItems;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'total_amount' => 'required|numeric',
            'cus_name' => 'required|string',
            'cus_email' => 'required|email',
            'cus_phone' => 'required|string',
            'cus_add1' => 'required|string',
            'cus_add2' => 'nullable|string',
            'cus_city' => 'required|string',
            'cus_company' => 'nullable|string',
            'cus_state' => 'required|string',
            'cus_country' => 'required|string',
            'cus_postcode' => 'required|string',
            'payment_method' => 'required|string',
            'delivery' => 'required|numeric',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|integer',
            'order_items.*.power' => 'nullable|string',
            'order_items.*.pair' => 'required|integer',
            'order_items.*.price' => 'required|numeric',
        ]);

        try {
            // Create order
            $order = Order::create([
                'user_id' => $validatedData['user_id'],
                'subtotal' => $validatedData['total_amount'],
                'currency' => 'BDT',
                'name' => $validatedData['cus_name'],
                'email' => $validatedData['cus_email'],
                'phone' => $validatedData['cus_phone'],
                'status' => 'Pending',
                'address_one' => $validatedData['cus_add1'],
                'address_two' => $validatedData['cus_add2'],
                'city' => $validatedData['cus_city'],
                'company' => $validatedData['cus_company'],
                'state' => $validatedData['cus_state'],
                'country' => $validatedData['cus_country'],
                'zip_code' => $validatedData['cus_postcode'],
                'delivery_charge' => $validatedData['delivery'],
                'payment_method' => $validatedData['payment_method'],
                'amount' => $validatedData['delivery'] + $validatedData['total_amount'],
                'transaction_id' => uniqid(),
            ]);

            // Save order items
            foreach ($validatedData['order_items'] as $item) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'power' => $item['power'],
                    'pair' => $item['pair'],
                    'price' => $item['price'],
                ]);
            }

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order' => $order
            ], 201);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Order creation failed: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Unable to create order. Please try again later.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function userOrder(string $userId)
    {
        try {
            $orders = Order::where('user_id', $userId)
                ->select('id', 'transaction_id', 'amount', 'status', 'created_at')
                ->with(['orderItems' => function ($query) {
                    $query->select('id', 'order_id', 'product_id', 'power', 'pair')
                        ->with(['product' => function ($subQuery) {
                            $subQuery->select('id', 'name');
                        }]);
                }])
                ->orderBy('created_at', 'asc')
                ->paginate(5);

            $orders->getCollection()->transform(function ($order) {
                $order->created_at =  Carbon::parse($order->created_at)->format('d M,Y');

                foreach ($order->orderItems as $item) {
                    $item->product_name = $item->product->name;
                    unset($item->product);
                }
                return $order;
            });

            if($orders->count() == 0){
                return response()->json([
                    'error' => true,
                    'message' => 'No Orders Found',
                ]);
            }

            // Return success message and paginated orders as JSON
            return response()->json([
                'success' => true,
                'message' => 'Orders retrieved successfully.',
                'orders' => $orders->items(), // Current page data
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'total' => $orders->total(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th,
            ]);
        }
    }

    public function singleOrder(string $orderId)
    {
        // Fetch the order without pagination
        $order = Order::where('id', $orderId)
            ->with(['orderItems' => function ($query) {
                $query->select('id', 'order_id', 'product_id', 'power', 'pair', 'price')
                    ->with(['product' => function ($subQuery) {
                        $subQuery->select('id', 'name'); // Select only name and id from products
                    }]);
            }])
            ->first(); // Get the single order

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found.',
            ], 404);
        }

        // Format date as 05, Oct 24
        $order->created_at = \Carbon\Carbon::parse($order->created_at)->format('d M, Y');

        // Modify the orderItems structure
        foreach ($order->orderItems as $item) {
            // Add product name directly into the orderItems
            $item->product_name = $item->product->name;
            unset($item->product); // Remove the product instance
        }

        // Return success message and order as JSON
        return response()->json([
            'success' => true,
            'message' => 'Order retrieved successfully.',
            'order' => $order,
        ]);
    }
}
