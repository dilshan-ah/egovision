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

        // Log::info('Validation passed.');

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

        if ($pairQuantity === 0 && $pairQuantitySecond === 0) {
            return response()->json([
                'success' => false,
                'error' => 'Cannot add to cart: Both quantities cannot be zero.'
            ], 400);
        }

        // Fetch the product
        $product = Product::find($request->input('productId'));

        // Check if the product exists
        if (!$product) {
            return response()->json([
                'success' => false,
                'error' => 'Product not found.'
            ], 404);
        }

        $cartDataFirst = [
            'product_id' => $request->input('productId'),
            'power_status' => $powerStatus,
            'power' => $powerStatus === 'no_power' ? null : $request->input('firstEyePower'),
            'pair' => $pairQuantity,
            'user_id' => $request->input('userId')
        ];

        $existingCartEntryFirst = Cart::where(function ($query) use ($cartDataFirst) {
            $query->where('product_id', $cartDataFirst['product_id'])
                ->where('user_id', $cartDataFirst['user_id'])
                ->where('power', $cartDataFirst['power']);
        })->first();

        if ($existingCartEntryFirst) {
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

                Cart::create($cartDataSecond);
            }
            // Check if the product type is 'normal' before calling the function
            if ($product->product_type == 'normal') {
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

                Cart::create($cartDataSecond);
            }

            // Check if the product type is 'normal' before calling the function
            if ($product->product_type == 'normal') {
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
            $accessoryCartData = [
                'product_id' => $accessory->id,
                'power_status' => 'no_power',
                'power' => null,
                'pair' => $totalBag,
                'user_id' => $userId
            ];
    
            $existingAccessoryEntry = Cart::where('product_id', $accessoryCartData['product_id'])
                ->where('user_id', $accessoryCartData['user_id'])
                ->first();
    
            if ($existingAccessoryEntry) {
                $existingAccessoryEntry->pair += $totalBag;
                $existingAccessoryEntry->save();
            } else {
                Cart::create($accessoryCartData);
            }
        } else {
            Log::info('No accessory found for product', ['product_id' => $product->id]);
        }
    }
    

    public function userCartList(string $id)
    {
        try {
            $cartItems = Cart::where('user_id', $id)
                ->with(['product' => function ($query) {
                    $query->select('id', 'name', 'price', 'no_power_price', 'image_path');
                }])
                ->get(['id', 'product_id', 'power', 'pair', 'power_status']); // Include power_status
    
            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty.',
                    'cartCount' => 0,
                    'cartTotal' => 0,
                    'cartItems' => []
                ], 404);
            }
    
            $formattedItems = $cartItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'power' => $item->power,
                    'pair' => $item->pair,
                    'power_status' => $item->power_status, // Ensure power_status is included
                    'product' => [
                        'id' => $item->product->id,
                        'name' => $item->product->name,
                        'price' => $item->power_status == 'no_power' ? $item->product->no_power_price : $item->product->price,
                        'image_path' => $item->product->image_path,
                    ]
                ];
            });
    
            $cartCount = $cartItems->sum('pair');
            $cartTotal = $cartItems->sum(function ($cart) {
                return $cart->power_status == 'no_power' ? $cart->product->no_power_price * $cart->pair : $cart->product->price * $cart->pair;
            });
    
            return response()->json([
                'success' => true,
                'message' => 'Cart items retrieved successfully.',
                'cartCount' => $cartCount,
                'cartTotal' => $cartTotal,
                'cartItems' => $formattedItems
            ], 200);
    
        } catch (\Exception $e) {
            Log::error('Error retrieving cart list: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Unable to retrieve cart items.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    public function updateCartQuantity(Request $request)
    {
        $cart = Cart::find($request->id);
        if (!$cart) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        $request->validate([
            'id' => 'required|integer|exists:carts,id',
            'action' => 'required|string|in:increment,decrement',
        ]);



        $product = $cart->product;
        $accessoryQuantity = 0;

        if ($request->action == 'increment') {
            $cart->pair += 1;

            $accessory = Product::where('product_type', 'accessories')
                ->where('is_default_bag', '1')
                ->first();

            if ($accessory) {
                $accessoryCartItem = Cart::where('product_id', $accessory->id)
                    ->where('session_id', $cart->session_id)
                    ->where('user_id', $cart->user_id)
                    ->first();

                if ($accessoryCartItem) {
                    $accessoryCartItem->pair += 1;
                    $accessoryCartItem->save();
                    $accessoryQuantity = $accessoryCartItem->pair;
                }
            }
        } elseif ($request->action == 'decrement') {
            if ($cart->pair > 1) {
                $cart->pair -= 1;

                $accessory = Product::where('product_type', 'accessories')
                    ->where('is_default_bag', '1')
                    ->first();

                if ($accessory) {
                    $accessoryCartItem = Cart::where('product_id', $accessory->id)
                        ->where('session_id', $cart->session_id)
                        ->where('user_id', $cart->user_id)
                        ->first();

                    if ($accessoryCartItem) {
                        $accessoryCartItem->pair -= 1;
                        $accessoryCartItem->save();
                        $accessoryQuantity = $accessoryCartItem->pair;
                    }
                }
            } else {
                return response()->json(['error' => 'Cannot decrement below 1'], 400);
            }
        } else {
            Log::error('Invalid action provided', ['action' => $request->action]);
            return response()->json(['error' => 'Invalid action'], 400);
        }

        $cart->save();

        $totalPrice = $cart->pair * $product->price;

        return response()->json([
            'success' => true,
            'pair' => $cart->pair,
            'totalPrice' => $totalPrice,
            'accessoryQuantity' => $accessoryQuantity
        ]);
    }

    public function deleteCart(string $id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart item not found.'], 404);
        }

        $product = Product::find($cart->product_id);

        if ($product && $product->product_type == 'normal') {
            $accessory = Cart::where('session_id', $cart->session_id)
                ->whereHas('product', function ($query) {
                    $query->where('product_type', 'accessories')
                        ->where('is_default_bag', '1');
                })->first();

            if ($accessory) {
                if ($accessory->pair > $cart->pair) {
                    $accessory->pair -= $cart->pair;
                    $accessory->save();
                } else {
                    $accessory->delete();
                }
            }
        }

        $cart->delete();
        return response()->json(['success' => true, 'message' => 'Item removed from cart.']);
    }

    public function addGiftToCart(Request $request, $userId)
    {
        try {

            $existingCart = Cart::where('user_id', $userId)->sum('pair');

            $product = Product::where('is_default_bag', '1')->first();

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'response_code' => 404,
                    'message' => 'Product not found.',
                    'data' => []
                ], 404);
            }

            $cartAccessoryData = [
                'product_id' => $product->id,
                'power_status' => 'no_power',
                'pair' => $request->quantity,
                'user_id' => $userId
            ];

            Cart::create($cartAccessoryData);

            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'Gift added to cart successfully.',
                'data' => $cartAccessoryData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'response_code' => 500,
                'message' => 'Server error: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
}
