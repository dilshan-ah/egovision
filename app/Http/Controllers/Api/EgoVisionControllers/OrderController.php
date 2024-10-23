<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Order;
use App\Models\EgoModels\OrderItems;
use App\Models\EgoModels\Product;
use App\Models\GeneralSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function checkPrices(Request $request)
    {
        $validatedData = $request->validate([
            'delivery_charge' => 'required|integer',
            'order_items.*.product_id' => 'required|integer',
            'order_items.*.power' => 'nullable|string',
            'order_items.*.quantity' => 'required|integer',
        ]);
    
        $subTotal = 0;
    
        foreach ($validatedData['order_items'] as $item) {
            $product = Product::where('id', $item['product_id'])->first();
    
            if (!$product) {
                return response()->json(['error' => 'Product not found.'], 404);
            }
    
            $price = $item['power'] != null ? $product->price : $product->no_power_price;
    
            $subTotal += $price * $item['quantity'];

            $discount =  ($product->is_free == 1 ? $product->no_power_price : 0) * $item['quantity'];
        }

        $tax = GeneralSetting::first()->tax;

        $taxPrice = $subTotal * $tax/100;

        $total = $request->delivery_charge + $taxPrice + $subTotal -$discount;
    
        return response()->json([
            'subTotal' => $subTotal,
            'tax' => $taxPrice,
            'delivery_charge' => $request->delivery_charge,
            'discount' => $discount,
            'total' => $total
        ]);
    }    

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|integer',
                'subtotal' => 'required|numeric',
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
                'transaction_id' => 'required|string|unique:orders',
                'discount' => 'required|numeric',
                'tax' => 'required|numeric',
                'total' => 'required|numeric',
                'status' => 'required',
                'payment_status' => 'required',
                'delivery' => 'required|numeric',
                'order_items' => 'required|array',
                'order_items.*.product_id' => 'required|integer',
                'order_items.*.power' => 'nullable|string',
                'order_items.*.pair' => 'required|integer',
                'order_items.*.price' => 'required|numeric',
            ]);
    
            $order = Order::create([
                'user_id' => $validatedData['user_id'],
                'subtotal' => $validatedData['subtotal'],
                'currency' => 'BDT',
                'name' => $validatedData['cus_name'],
                'email' => $validatedData['cus_email'],
                'phone' => $validatedData['cus_phone'],
                'status' => $validatedData['status'],
                'payment_status' => $validatedData['payment_status'],
                'address_one' => $validatedData['cus_add1'],
                'address_two' => $validatedData['cus_add2'],
                'city' => $validatedData['cus_city'],
                'company' => $validatedData['cus_company'],
                'state' => $validatedData['cus_state'],
                'country' => $validatedData['cus_country'],
                'zip_code' => $validatedData['cus_postcode'],
                'discount' => $validatedData['discount'],
                'delivery_charge' => $validatedData['delivery'],
                'payment_method' => $validatedData['payment_method'],
                'tax' => $validatedData['tax'],
                'amount' => $validatedData['total'],
                'transaction_id' => $validatedData['transaction_id']
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
        } catch (ValidationException $e) {
            // Return validation error messages
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->validator->errors(), // Get validation errors
            ], 422);
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
                    $item->product_name = @$item->product->name;
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
            $item->product_name = @$item->product->name;
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
