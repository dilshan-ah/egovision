<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EgoModels\Cart;
use App\Models\EgoModels\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validate request data
        $request->validate([
            'powerType' => 'required|string',
            'productId' => 'required|integer|exists:products,id',
            'nopairQuantity' => 'nullable|integer|min:0',
            'firstEyeQuantity' => 'nullable|integer|min:0',
            'secondEyeQuantity' => 'nullable|integer|min:0',
            'firstEyePower' => 'nullable|string',
            'secondEyePower' => 'nullable|string',
        ]);
    
        $powerStatus = $request->input('powerType');
        $pairQuantity = 0;
        $pairQuantitySecond = 0;
        $totalBag = 0;
    
        // Determine quantities based on power status
        if ($powerStatus === "no_power") {
            $pairQuantity = (int) $request->input('nopairQuantity');
            $totalBag = $pairQuantity;
        } else {
            $pairQuantity = (int) $request->input('firstEyeQuantity');
            $pairQuantitySecond = (int) $request->input('secondEyeQuantity');
            $totalBag = $pairQuantity + $pairQuantitySecond;
        }
    
        // Check for valid quantities
        if ($pairQuantity === 0 && $pairQuantitySecond === 0) {
            return response()->json([
                'success' => false,
                'error' => 'Cannot add to cart: Both quantities cannot be zero.'
            ], 400); // Bad Request
        }
    
        // Fetch the product being added
        $product = Product::find($request->input('productId'));
    
        // Prepare cart data for the first entry
        $cartDataFirst = [
            'product_id' => $request->input('productId'),
            'power_status' => $powerStatus,
            'power' => $powerStatus === 'no_power' ? null : $request->input('firstEyePower'),
            'pair' => $pairQuantity,
            'user_id' => $request->userId
        ];
    
        // Check for existing cart entry based on user_id, product_id, and power
        $existingCartEntryFirst = Cart::where(function ($query) use ($cartDataFirst) {
            $query->where('product_id', $cartDataFirst['product_id'])
                ->where('user_id', $cartDataFirst['user_id'])
                ->where('power', $cartDataFirst['power']);
        })->orWhere(function ($query) use ($cartDataFirst) {
            $query->where('product_id', $cartDataFirst['product_id'])
                ->where('power', $cartDataFirst['power']);
        })->first();
    
        // If an existing cart entry is found, update the pair quantity
        if ($existingCartEntryFirst) {
            $existingCartEntryFirst->pair += $pairQuantity; // Increment the pair quantity
            $existingCartEntryFirst->save();
    
            // Check if we need to handle the second eye power
            $powerSecond = $request->input('secondEyePower');
            if ($powerSecond != '' && $powerSecond !== $cartDataFirst['power']) {
                // Prepare cart data for the second entry
                $cartDataSecond = [
                    'product_id' => $request->input('productId'),
                    'power_status' => $powerStatus,
                    'power' => $powerSecond,
                    'pair' => $pairQuantitySecond,
                    'user_id' => $request->userId
                ];
    
                // Create the second cart instance
                Cart::create($cartDataSecond);
            }
    
            // Add accessories if the product is a normal product
            if ($product->product_type == 'normal') {
                $this->addAccessoryToCart($product, $totalBag, $request->userId);
            }
            return response()->json([
                'success' => true,
                'message' => 'Quantity updated in cart.',
                'cartCount' => Cart::where('user_id', Auth::id())
                    ->count()
            ]);
        }
    
        // If no existing entry, create a new cart instance for the first entry
        try {
            Cart::create($cartDataFirst);
    
            // Check if we need to create a second entry for power
            $powerSecond = $request->input('secondEyePower');
            if ($powerSecond != '' && $powerSecond !== $cartDataFirst['power']) {
                // Prepare cart data for the second entry
                $cartDataSecond = [
                    'product_id' => $request->input('productId'),
                    'power_status' => $powerStatus,
                    'power' => $powerSecond,
                    'pair' => $pairQuantitySecond,
                    'user_id' => $request->userId
                ];
    
                // Create the second cart instance
                Cart::create($cartDataSecond);
            }
    
            // Add accessories if the product is a normal product
            if ($product->product_type == 'normal') {
                $this->addAccessoryToCart($product, $totalBag, $request->userId);
            }
    
            $cartCount = Cart::where('user_id', $request->userId)
                ->sum('pair');
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart.',
                'cartCount' => $cartCount
            ]);
    
        } catch (\Exception $e) {
            Log::error('Failed to add to cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Unable to add to cart.'
            ], 500); // Server Error
        }
    }
    
    protected function addAccessoryToCart($product, $totalBag, $userId)
    {
        $accessory = Product::where('product_type', 'accessories')
            ->where('is_default_bag', '1')
            ->first();
    
        if ($accessory) {
            // Prepare cart data for the accessory
            $accessoryCartData = [
                'product_id' => $accessory->id,
                'power_status' => 'no_power',
                'power' => null,
                'pair' => $totalBag,
                'user_id' => $userId
            ];
    
            // Check if the accessory is already in the cart
            $existingAccessoryEntry = Cart::where(function ($query) use ($accessoryCartData) {
                $query->where('product_id', $accessoryCartData['product_id'])
                    ->where('user_id', $accessoryCartData['user_id']);
            })->orWhere(function ($query) use ($accessoryCartData) {
                $query->where('product_id', $accessoryCartData['product_id']);
            })->first();
    
            // If accessory already exists, update the quantity
            if ($existingAccessoryEntry) {
                $existingAccessoryEntry->pair += $totalBag;
                $existingAccessoryEntry->save();
            } else {
                // Otherwise, create a new entry for the accessory
                Cart::create($accessoryCartData);
            }
        }
    }
    

    public function userCartList(string $id)
    {
        try {
            $cartItems = Cart::where('user_id', $id)
                ->with(['product' => function($query) {
                    $query->select('id', 'name', 'price', 'image_path');
                }])
                ->get(['id', 'product_id', 'power', 'pair']);
    
            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty.',
                    'cartCount' => 0,
                    'cartTotal' => 0,
                    'cartItems' => []
                ], 404);
            }
    
            $cartCount = $cartItems->sum('pair');
            $cartTotal = $cartItems->sum(function($cart) {
                return $cart->product->price * $cart->pair;
            });
    
            return response()->json([
                'success' => true,
                'message' => 'Cart items retrieved successfully.',
                'cartCount' => $cartCount,
                'cartTotal' => $cartTotal,
                'cartItems' => $cartItems
            ], 200); // OK
    
        } catch (\Exception $e) {
            Log::error('Error retrieving cart list: ' . $e->getMessage());
    
            // Structure the error response
            return response()->json([
                'success' => false,
                'message' => 'Unable to retrieve cart items.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    
    
}
