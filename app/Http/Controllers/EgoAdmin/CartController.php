<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EgoModels\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $sessionId = $request->session()->getId();
        
        // Determine power status and pair quantities
        $powerStatus = $request->input('powerType');
        $pairQuantity = '0';
        $pairQuantitySecond = '0';
    
        if ($powerStatus == "no_power") {
            $pairQuantity = $request->input('nopairQuantity');
        } else {
            $pairQuantity = $request->input('firstEyeQuantity'); // Set the pairQuantity to firstEyeQuantity
            $pairQuantitySecond = $request->input('secondEyeQuantity'); // Get the second eye quantity
        }
    
        // If pairQuantity is 0 for first or second, return a message
        if ($pairQuantity == '0' && $pairQuantitySecond == '0') {
            return response()->json([
                'success' => false,
                'error' => 'Cannot add to cart: Both quantities cannot be zero.'
            ], 400); // Bad Request
        }
    
        // Prepare cart data for the first entry
        $cartDataFirst = [
            'session_id' => $sessionId,
            'product_id' => $request->input('productId'),
            'power_status' => $powerStatus,
            'power' => $powerStatus == 'no_power' ? null : $request->input('firstEyePower'),
            'pair' => $pairQuantity,
            'user_id' => Auth::check() ? Auth::user()->id : null
        ];
    
        // Check for existing cart entry based on user_id, product_id, and power
        $existingCartEntryFirst = Cart::where(function ($query) use ($cartDataFirst) {
            $query->where('product_id', $cartDataFirst['product_id'])
                  ->where('user_id', $cartDataFirst['user_id'])
                  ->where('power', $cartDataFirst['power']);
        })->orWhere(function ($query) use ($cartDataFirst, $sessionId) {
            $query->where('product_id', $cartDataFirst['product_id'])
                  ->where('session_id', $sessionId)
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
                    'session_id' => $sessionId,
                    'product_id' => $request->input('productId'),
                    'power_status' => $powerStatus,
                    'power' => $powerSecond,
                    'pair' => $pairQuantitySecond, // Use secondEyeQuantity for the second entry
                    'user_id' => Auth::check() ? Auth::user()->id : null
                ];
    
                // Create the second cart instance
                $cartSecond = Cart::create($cartDataSecond);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Quantity updated in cart.',
                'cartCount' => Cart::where('session_id', $sessionId)
                                   ->orWhere('user_id', Auth::id())
                                   ->count()
            ]);
        }
    
        // If no existing entry, create a new cart instance for the first entry
        try {
            $cartFirst = Cart::create($cartDataFirst);
            
            // Check if we need to create a second entry for power
            $powerSecond = $request->input('secondEyePower');
    
            if ($powerSecond != '' && $powerSecond !== $cartDataFirst['power']) {
                // Prepare cart data for the second entry
                $cartDataSecond = [
                    'session_id' => $sessionId,
                    'product_id' => $request->input('productId'),
                    'power_status' => $powerStatus,
                    'power' => $powerSecond,
                    'pair' => $pairQuantitySecond, // Use secondEyeQuantity for the second entry
                    'user_id' => Auth::check() ? Auth::user()->id : null
                ];
    
                // Create the second cart instance
                $cartSecond = Cart::create($cartDataSecond);
            }
    
            $cartCount = Cart::where('session_id', $sessionId)
                        ->orWhere('user_id', Auth::id())
                        ->count();
    
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
    
    public function cartItems()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get(); // Adjust as necessary
        $subtotal = $carts->sum(function($cart) {
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
    
        // Calculate the total price of products in the cart
        $cartTotal = Cart::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
        ->with('product') // Ensure the product relation is loaded
        ->get()
        ->sum(function ($cart) {
            return $cart->pair * $cart->product->price; // Calculate total price for each cart item
        });
    
        return response()->json(['cartTotal' => $cartTotal]);
    }
    

    public function updateCartQuantity(Request $request)
    {
        $cart = Cart::find($request->id);
        if (!$cart) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }
    
        if ($request->action == 'increment') {
            $cart->pair += 1;
        } elseif ($request->action == 'decrement' && $cart->pair > 1) {
            $cart->pair -= 1;
        }
    
        $cart->save();
    
        $totalPrice = $cart->pair * $cart->product->price;
    
        return response()->json([
            'pair' => $cart->pair,
            'totalPrice' => $totalPrice
        ]);
    }

    public function delectCart(string $id)
    {
        $cart = Cart::find($id);

        $cart->delete();

        $cart->delete();

        return redirect()->back();
    }
    
    
}
