<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EgoModels\Cart;
use App\Models\EgoModels\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        Log::info($request->all());
        $sessionId = $request->session()->getId();
        $userId = Auth::user()->id ?? null; // assuming user_id is passed in the request

        $powerStatus = $request->input('powerType');
        $pairQuantity = '0';
        $pairQuantitySecond = '0';
        $totalBag = '0';

        if ($powerStatus === "no_power") {
            $pairQuantity = $request->input('nopairQuantity', 0);
            $totalBag = $pairQuantity;
        } else {
            $pairQuantity = $request->input('firstEyeQuantity', 0);
            $pairQuantitySecond = $request->input('secondEyeQuantity', 0);
            $totalBag = $pairQuantity + $pairQuantitySecond;
        }

        // If pairQuantity is 0 for both first or second, return an error
        if ($pairQuantity == '0' && $pairQuantitySecond == '0') {
            return response()->json([
                'success' => false,
                'error' => 'Cannot add to cart: Both quantities cannot be zero.'
            ], 400); // Bad Request
        }

        $product = Product::find($request->input('productId'));

        $cartDataFirst = [
            'session_id' => $sessionId,
            'product_id' => $request->input('productId'),
            'power_status' => $powerStatus,
            'power' => $powerStatus === 'no_power' ? null : $request->input('firstEyePower'),
            'pair' => $pairQuantity,
            'user_id' => $userId
        ];

        Log::error($cartDataFirst);

        // Check for existing cart entry
        $existingCartEntryFirst = Cart::where(function ($query) use ($cartDataFirst) {
            $query->where('product_id', $cartDataFirst['product_id'])
                ->where('user_id', $cartDataFirst['user_id'])
                ->where('power', $cartDataFirst['power']);
        })->orWhere(function ($query) use ($cartDataFirst, $sessionId) {
            $query->where('product_id', $cartDataFirst['product_id'])
                ->where('session_id', $sessionId)
                ->where('power', $cartDataFirst['power']);
        })->first();

        if ($existingCartEntryFirst) {
            $existingCartEntryFirst->pair += $pairQuantity;
            $existingCartEntryFirst->save();

            $powerSecond = $request->input('secondEyePower');
            if ($powerSecond !== '' && $powerSecond !== $cartDataFirst['power']) {
                $cartDataSecond = [
                    'session_id' => $sessionId,
                    'product_id' => $request->input('productId'),
                    'power_status' => $powerStatus,
                    'power' => $powerSecond,
                    'pair' => $pairQuantitySecond,
                    'user_id' => $userId
                ];
                Cart::create($cartDataSecond);
            }

            if ($product->product_type === 'normal') {
                $this->addAccessoryToCart($sessionId, $product, $totalBag, $userId);
            }

            $cartCount = Cart::where('session_id', $sessionId)
                ->orWhere('user_id', $userId)
                ->sum('pair');

            return response()->json([
                'success' => true,
                'message' => 'Quantity updated in cart.',
                'cartCount' => $cartCount
            ]);
        }

        try {
            Cart::create($cartDataFirst);

            $powerSecond = $request->input('secondEyePower');
            if ($powerSecond !== '' && $powerSecond !== $cartDataFirst['power']) {
                $cartDataSecond = [
                    'session_id' => $sessionId,
                    'product_id' => $request->input('productId'),
                    'power_status' => $powerStatus,
                    'power' => $powerSecond,
                    'pair' => $pairQuantitySecond,
                    'user_id' => $userId
                ];
                Cart::create($cartDataSecond);
            }

            if ($product->product_type === 'normal') {
                $this->addAccessoryToCart($sessionId, $product, $totalBag, $userId);
            }

            $cartCount = Cart::where('session_id', $sessionId)
                ->orWhere('user_id', $userId)
                ->sum('pair');

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart.',
                'cartCount' => $cartCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Unable to add to cart.'
            ], 500);
        }
    }

    protected function addAccessoryToCart($sessionId, $product, $totalBag, $userId)
    {
        $accessory = Product::where('product_type', 'accessories')
            ->where('is_default_bag', 1)
            ->first();

        if ($accessory) {
            $accessoryCartData = [
                'session_id' => $sessionId,
                'product_id' => $accessory->id,
                'power_status' => 'no_power',
                'power' => null,
                'pair' => $totalBag,
                'user_id' => $userId
            ];

            $existingAccessoryEntry = Cart::where(function ($query) use ($accessoryCartData) {
                $query->where('product_id', $accessoryCartData['product_id'])
                    ->where('user_id', $accessoryCartData['user_id']);
            })->orWhere(function ($query) use ($accessoryCartData, $sessionId) {
                $query->where('product_id', $accessoryCartData['product_id'])
                    ->where('session_id', $sessionId);
            })->first();

            if ($existingAccessoryEntry) {
                $existingAccessoryEntry->pair += $totalBag;
                $existingAccessoryEntry->save();
            } else {
                Cart::create($accessoryCartData);
            }
        }
    }


    public function cartItems()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get(); // Adjust as necessary
        $subtotal = $carts->sum(function ($cart) {
            return $cart->pair * $cart->product->price;
        });

        return response()->json([
            'carts' => $carts,
            'subtotal' => $subtotal,
        ]);
    }

    public function getCartCount(Request $request)
    {
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $request->session()->getId();

        $cartCount = Cart::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->sum('pair');

        return response()->json(['cartCount' => $cartCount]);
    }

    public function getCartTotalPrice(Request $request)
    {
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $request->session()->getId();
    
        $cartTotal = Cart::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
        ->with('product')
        ->get()
        ->sum(function ($cart) {
            $productPrice = $cart->power_status == 'no_power' ? $cart->product->no_power_price : $cart->product->price;
    
            return $cart->pair * $productPrice;
        });
    
        return response()->json(['cartTotal' => $cartTotal]);
    }    

    public function updateCartQuantity(Request $request)
    {

        // Find the cart item
        $cart = Cart::find($request->id);
        if (!$cart) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        // Get the product type
        $product = $cart->product;
        $accessoryQuantity = 0;
        // Determine the action (increment or decrement)
        if ($request->action == 'increment') {
            $cart->pair += 1;

            // Update accessory if the cart item is a normal product
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

                // Update accessory if the cart item is a normal product
                $accessory = Product::where('product_type', 'accessories')
                    ->where('is_default_bag', '1')
                    ->first();

                if ($accessory) {
                    $accessoryCartItem = Cart::where('product_id', $accessory->id)
                        ->where('session_id', $cart->session_id)
                        ->where('user_id', $cart->user_id)
                        ->first();

                    if ($accessoryCartItem) {
                        $accessoryCartItem->pair -= 1; // Decrease the accessory quantity
                        $accessoryCartItem->save();
                        $accessoryQuantity = $accessoryCartItem->pair;
                    }
                }
            }
        } else {
            Log::error('Invalid action provided', ['action' => $request->action]);
            return response()->json(['error' => 'Invalid action'], 400);
        }

        $cart->save();

        // Calculate the total price for the updated cart item
        $totalPrice = $cart->pair * $product->price;

        // Return response with updated pair and total price
        return response()->json([
            'pair' => $cart->pair,
            'totalPrice' => $totalPrice,
            'accessoryQuantity' => $accessoryQuantity
        ]);
    }

    public function getAccessoryQuantity(Request $request)
    {
        // Assuming you're using session-based authentication
        $sessionId = $request->session()->getId(); // Get the current session ID
        $userId = auth()->id(); // Get the authenticated user ID

        // Find the cart associated with the session and user
        $cart = Cart::where('session_id', $sessionId)
            ->where('user_id', $userId)
            ->first();

        if (!$cart) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        // Find the accessory product
        $accessory = Product::where('product_type', 'accessories')
            ->where('is_default_bag', '1')
            ->first();

        if ($accessory) {
            // Find the accessory cart item based on the product and user session
            $accessoryCartItem = Cart::where('product_id', $accessory->id)
                ->where('session_id', $sessionId)
                ->where('user_id', $userId)
                ->first();

            if ($accessoryCartItem) {
                return response()->json(['accessoryQuantity' => $accessoryCartItem->pair]);
            }
        }
        Log::info($accessoryCartItem->pair);
        return response()->json(['accessoryQuantity' => 0]); // Return 0 if no accessory found
    }



    public function deleteCart(string $id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return redirect()->back()->withErrors('Cart item not found.');
        }

        $product = Product::find($cart->product_id);

        if ($product->product_type == 'normal') {
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
        return redirect()->back()->with('success', 'Item removed from cart.');
    }


    public function addGiftToCart()
    {
        $existingCart = Cart::where('user_id', Auth::user()->id)->sum('pair');
        $product = Product::where('is_default_bag', '1')->first();
        $userId = auth()->id();
        $cartAccessoryData = [
            'product_id' => $product->id,
            'power_status' => 'no_power',
            'pair' => $existingCart, // Use secondEyeQuantity for the second entry
            'user_id' => Auth::check() ? Auth::user()->id : null
        ];

        Cart::create($cartAccessoryData);

        return redirect()->back();
    }
}
