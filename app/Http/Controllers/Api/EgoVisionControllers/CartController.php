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
        Log::info('Request Data:', $request->all());
        
        $request->validate([
            'powerType' => 'required|string',
            'productId' => 'required|integer|exists:products,id',
            'nopairQuantity' => 'nullable|integer|min:0',
            'firstEyeQuantity' => 'nullable|integer|min:0',
            'secondEyeQuantity' => 'nullable|integer|min:0',
            'firstEyePower' => 'nullable|string',
            'secondEyePower' => 'nullable|string',
            'userId' => 'required|integer|exists:users,id',
        ]);
    
        Log::info('Validation passed.');
    
        $powerStatus = $request->input('powerType');
        $pairQuantity = 0;
        $pairQuantitySecond = 0;
        $totalBag = 0;
    
        // Determine quantities based on power status
        if ($powerStatus === "no_power") {
            $pairQuantity = (int) $request->input('nopairQuantity');
            $totalBag = $pairQuantity;
            Log::info('Power status: no_power, Pair quantity: ' . $pairQuantity);
        } else {
            $pairQuantity = (int) $request->input('firstEyeQuantity');
            $pairQuantitySecond = (int) $request->input('secondEyeQuantity');
            $totalBag = $pairQuantity + $pairQuantitySecond;
            Log::info('Power status: power, First pair quantity: ' . $pairQuantity . ', Second pair quantity: ' . $pairQuantitySecond);
        }
    
        if ($pairQuantity === 0 && $pairQuantitySecond === 0) {
            Log::warning('Both quantities are zero.');
            return response()->json([
                'success' => false,
                'error' => 'Cannot add to cart: Both quantities cannot be zero.'
            ], 400);
        }
    
        $product = Product::find($request->input('productId'));
        Log::info('Product found:', ['product_id' => $product->id]);
    
        $cartDataFirst = [
            'product_id' => $request->input('productId'),
            'power_status' => $powerStatus,
            'power' => $powerStatus === 'no_power' ? null : $request->input('firstEyePower'),
            'pair' => $pairQuantity,
            'user_id' => $request->input('userId')
        ];
    
        Log::info('Cart data for first eye prepared:', $cartDataFirst);
    
        $existingCartEntryFirst = Cart::where(function ($query) use ($cartDataFirst) {
            $query->where('product_id', $cartDataFirst['product_id'])
                ->where('user_id', $cartDataFirst['user_id'])
                ->where('power', $cartDataFirst['power']);
        })->first();
    
        if ($existingCartEntryFirst) {
            Log::info('Existing cart entry found:', $existingCartEntryFirst->toArray());
            $existingCartEntryFirst->pair += $pairQuantity;
            $existingCartEntryFirst->save();
    
            $powerSecond = $request->input('secondEyePower');
            if ($powerSecond != '' && $powerSecond !== $cartDataFirst['power']) {
                $cartDataSecond = [
                    'product_id' => $request->input('productId'),
                    'power_status' => $powerStatus,
                    'power' => $powerSecond,
                    'pair' => $pairQuantitySecond,
                    'user_id' => $request->input('userId')
                ];
    
                Log::info('Cart data for second eye prepared:', $cartDataSecond);
                Cart::create($cartDataSecond);
            }
    
            if ($product->product_type == 'normal') {
                Log::info('Adding accessory to cart for normal product.');
                $this->addAccessoryToCart($product, $totalBag, $request->input('userId'));
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Quantity updated in cart.',
                'cartCount' => Cart::where('user_id', $request->input('userId'))->sum('pair')
            ]);
        }
    
        // No existing entry, create a new cart instance
        try {
            Log::info('Creating new cart entry for first eye.');
            Cart::create($cartDataFirst);
    
            $powerSecond = $request->input('secondEyePower');
            if ($powerSecond != '' && $powerSecond !== $cartDataFirst['power']) {
                $cartDataSecond = [
                    'product_id' => $request->input('productId'),
                    'power_status' => $powerStatus,
                    'power' => $powerSecond,
                    'pair' => $pairQuantitySecond,
                    'user_id' => $request->input('userId')
                ];
    
                Log::info('Creating new cart entry for second eye:', $cartDataSecond);
                Cart::create($cartDataSecond);
            }
    
            if ($product->product_type == 'normal') {
                Log::info('Adding accessory to cart for normal product.');
                $this->addAccessoryToCart($product, $totalBag, $request->input('userId'));
            }
    
            $cartCount = Cart::where('user_id', $request->input('userId'))->sum('pair');
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart.',
                'cartCount' => $cartCount
            ]);
    
        } catch (\Exception $e) {
            Log::error('Failed to add to cart:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'error' => 'Unable to add to cart.'
            ], 500);
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
