<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Order;
use App\Models\EgoModels\OrderItems;
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
    
    
}
