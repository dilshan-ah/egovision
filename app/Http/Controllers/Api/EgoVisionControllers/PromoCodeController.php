<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function verifyPromo(Request $request)
    {
        $request->validate([
            'promo_code' => 'nullable|string|max:255',
            'subtotal' => 'required|numeric|min:0',
            'delivery_fee' => 'required|numeric',
        ]);
    
        $promoCode = $request->input('promo_code');
        $subtotal = $request->input('subtotal');
        $delivery = $request->input('delivery_fee');
    
        $taxRate = GeneralSetting::first()->tax;
        $taxPrice = $subtotal * $taxRate / 100;
    
        if (empty($promoCode)) {
            $newTotal = $subtotal + $taxPrice + $delivery;
    
            return response()->json([
                'success' => true,
                'message' => 'No promo code applied',
                'tax' => number_format($taxPrice, 2),
                'delivery' => number_format($delivery, 2),
                'discount' => 0,
                'new_total' => number_format($newTotal, 2),
            ]);
        }
    
        $promo = PromoCode::where('reedem_code', $promoCode)
            ->where('status', 'active')
            ->first();
    
        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid promo code',
                'tax' => number_format($taxPrice, 2),
                'delivery' => number_format($delivery, 2),
                'discount' => 0,
                'new_total' => number_format($subtotal + $delivery + $taxPrice, 2),
            ], 400);
        }
    
        if ($subtotal < $promo->min_amount) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum order amount not met',
                'tax' => 0,
                'delivery' => number_format($delivery, 2),
                'discount' => 0,
                'new_total' => number_format($subtotal + $delivery, 2),
            ], 400);
        }
    
        $discount = floatval($promo->offer_amount) / 100 * floatval($subtotal);
    
        $newTotal = (float)$subtotal - (float)$discount + $taxPrice + $delivery;
    
        return response()->json([
            'success' => true,
            'message' => 'Promo code applied successfully',
            'tax' => number_format($taxPrice, 2),
            'delivery' => number_format($delivery, 2),
            'discount' => number_format($discount, 2),
            'new_total' => number_format($newTotal, 2),
        ]);
    }
    
}
