<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function verifyPromo(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string|max:255',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $promoCode = $request->input('promo_code');
        $subtotal = $request->input('subtotal');

        // Fetch the promo code from the database
        $promo = PromoCode::where('reedem_code', $promoCode)
            ->where('status', 'active')
            ->first();

        if (!$promo) {
            return response()->json(['success' => false, 'message' => 'Invalid promo code'], 400);
        }

        if ($subtotal < $promo->min_amount) {
            return response()->json(['success' => false, 'message' => 'Minimum order amount not met'], 400);
        }

        $discount = floatval($promo->offer_amount) / 100 * floatval($subtotal);
        $newTotal = (float)$subtotal - (float)$discount;

        return response()->json([
            'success' => true,
            'message' => 'Promo code applied successfully',
            'discount' => number_format($discount, 2),
            'new_total' => number_format($newTotal, 2),
        ]);
    }
}
