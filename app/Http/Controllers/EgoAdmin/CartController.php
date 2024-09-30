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
    
        // Determine power status
        $powerStatus = $request->input('powerType');
        $pairQuantity = '0';
    
        if ($powerStatus == "no_power") {
            $pairQuantity = $request->input('nopairQuantity');
        } elseif ($request->input('firstEyeSingleQuantity') != '0') {
            $pairQuantity = $request->input('firstEyeSingleQuantity');
        } else {
            $pairQuantity = $request->input('firstEyeQuantity'); // Set the pairQuantity to firstEyeQuantity
        }
    
        // First cart data
        $cartDataFirst = [
            'session_id' => $sessionId,
            'product_id' => $request->input('productId'),
            'power_status' => $powerStatus,
            'power' => $powerStatus == 'no_power' ? null : 
                      ($request->input('firstEyeSinglePower') ?: $request->input('firstEyePower')),
            'pair' => $pairQuantity,
            'user_id' => Auth::check() ? Auth::user()->id : null
        ];
    
        // Initialize a variable to store the cart instance
        $cartInstances = [];
        
        try {
            // Create first cart instance
            $cartFirst = Cart::create($cartDataFirst);
            $cartInstances[] = $cartFirst; // Store the first cart instance
    
            // Check if power for the first and second entries are different
            $powerFirst = $cartDataFirst['power'];
            $powerSecond = $request->input('secondEyePower');
    
            if ($powerSecond != '' && $powerFirst !== $powerSecond) {
                // Use the secondEyeQuantity for the second pair
                $secondPairQuantity = $request->input('secondEyeQuantity');
    
                $cartDataSecond = [
                    'session_id' => $sessionId,
                    'product_id' => $request->input('productId'),
                    'power_status' => $powerStatus,
                    'power' => $powerSecond,
                    'pair' => $secondPairQuantity, // Use secondEyeQuantity for the second entry
                    'user_id' => Auth::check() ? Auth::user()->id : null
                ];
    
                // Create the second cart instance
                $cartSecond = Cart::create($cartDataSecond);
                $cartInstances[] = $cartSecond; // Store the second cart instance
            }

            $cartCount = Cart::where('session_id', $sessionId)
                        ->orWhere('user_id', Auth::id())
                        ->count();

        } catch (\Exception $e) {
            
            return response()->json(['success' => false, 'error' => 'Unable to add to cart.'], 500);
        }
    
        
        return response()->json(['success' => true, 'carts' => $cartInstances, 'cartCount' => $cartCount]);
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
    }
    
    
}
