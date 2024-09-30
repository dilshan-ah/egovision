<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EgoModels\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $messages = [
            'userId.required' => 'User ID is required.',
            'userId.integer' => 'User ID must be an integer.',
            'userId.exists' => 'User ID must exist in the users table.',
            'productId.required' => 'Product ID is required.',
            'productId.integer' => 'Product ID must be an integer.',
            'productId.exists' => 'Product ID must exist in the products table.',
            'powerType.required' => 'Power type is required.',
            'powerType.in' => 'Power type must be either "no_power" or "with_power".',
        ];
    
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer|exists:users,id',
            'productId' => 'required|integer|exists:products,id',
            'powerType' => 'required|in:no_power,with_power',
        ], $messages);
    
        // If validation fails, return a JSON response with errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422); // Unprocessable Entity
        }
    
        Log::info('Request data: ', $request->all());
    
        $userId = $request->input('userId');
    
        $user = User::findOrFail($userId);
        
        $powerStatus = $request->input('powerType');
        $pairQuantity = '0';
    
        if ($powerStatus == "no_power") {
            $pairQuantity = $request->input('nopairQuantity');
        } elseif ($request->input('firstEyeSingleQuantity') != '0') {
            $pairQuantity = $request->input('firstEyeSingleQuantity');
        } else {
            $pairQuantity = $request->input('firstEyeQuantity');
        }
    
        $cartDataFirst = [
            'product_id' => $request->input('productId'),
            'power_status' => $powerStatus,
            'power' => $powerStatus == 'no_power' ? null : 
                      ($request->input('firstEyeSinglePower') ?: $request->input('firstEyePower')),
            'pair' => $pairQuantity,
            'user_id' => $user->id // Use the retrieved user ID
        ];
    
        $cartInstances = [];
    
        try {
            $cartFirst = Cart::create($cartDataFirst);
            $cartInstances[] = $cartFirst;
    
            $powerFirst = $cartDataFirst['power'];
            $powerSecond = $request->input('secondEyePower');
    
            if ($powerSecond != '' && $powerFirst !== $powerSecond) {
                $secondPairQuantity = $request->input('secondEyeQuantity');
    
                $cartDataSecond = [
                    'product_id' => $request->input('productId'),
                    'power_status' => $powerStatus,
                    'power' => $powerSecond,
                    'pair' => $secondPairQuantity,
                    'user_id' => $user->id // Use the retrieved user ID
                ];
    
                $cartSecond = Cart::create($cartDataSecond);
                $cartInstances[] = $cartSecond;
            }
    
            $cartCount = Cart::where('user_id', $user->id)->count();
    
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Unable to add to cart.'], 500);
        }
    
        return response()->json(['success' => true, 'carts' => $cartInstances, 'cartCount' => $cartCount]);
    }
      
    
}
