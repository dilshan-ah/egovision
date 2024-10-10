<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Promo Code';
        $promocodes = PromoCode::all();
        return view('admin.promocode.index', compact('pageTitle', 'promocodes'));
    }

    public function create()
    {
        $pageTitle = 'Create Promo Code';
        return view('admin.promocode.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'nullable|string|max:255',
            'reedem_code' => 'required|string|max:50|unique:promo_codes,reedem_code',
            'offer_type' => 'required|string',
            'free_delivery' => 'nullable',
            'offer_amount' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
        ]);

        try {
            $promo = new PromoCode();
            $promo->note = $request->note;
            $promo->reedem_code = $request->reedem_code;
            $promo->offer_type = $request->offer_type;
            $promo->free_delivery = $request->free_delivery;
            $promo->offer_amount = $request->offer_amount;
            $promo->min_amount = $request->min_amount;
            $promo->status = $request->status;

            $promo->save();
            $notify[] = ['success', 'Promo Code added successfully.'];

            return redirect()->route('promo.index')->withNotify($notify)->withInput();
        } catch (\Throwable $th) {
            $notify[] = ['error', 'Failed to create Promo Code.'];
            return redirect()->back()->withNotify($notify)->withInput();
        }
    }

    public function edit(string $id)
    {
        $pageTitle = 'Edit Promo Code';
        $promo = PromoCode::where('id',$id)->first();
        return view('admin.promocode.edit', compact('pageTitle','promo'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'note' => 'nullable|string|max:255',
            'reedem_code' => 'required|string|max:50',
            'offer_type' => 'required|string',
            'free_delivery' => 'nullable',
            'offer_amount' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
        ]);

        try {
            $promo = PromoCode::where('id',$id)->first();
            $promo->note = $request->note;
            $promo->reedem_code = $request->reedem_code;
            $promo->offer_type = $request->offer_type;
            $promo->free_delivery = $request->free_delivery;
            $promo->offer_amount = $request->offer_amount;
            $promo->min_amount = $request->min_amount;
            $promo->status = $request->status;

            $promo->save();
            $notify[] = ['success', 'Promo Code updated successfully.'];

            return redirect()->route('promo.index')->withNotify($notify)->withInput();
        } catch (\Throwable $th) {
            $notify[] = ['error', 'Failed to update Promo Code.'];
            return redirect()->back()->withNotify($notify)->withInput();
        }
    }


    public function delete(string $id)
    {
        try {
            $promo = PromoCode::find($id);

            $promo->delete();
            $notify[] = ['success', 'Promo Code deleted successfully.'];

            return redirect()->back()->withNotify($notify)->withInput();
        } catch (\Throwable $th) {

            $notify[] = ['error', $th];

            return redirect()->back()->withNotify($notify)->withInput();
        }
    }


    public function verifyPromo(Request $request)
    {
        $promoCode = $request->input('promo_code');
        $subtotal = $request->input('subtotal');

        // Fetch the promo code from the database
        $promo = PromoCode::where('reedem_code', $promoCode)->where('status', 'active')->first();

        if (!$promo) {
            return response()->json(['success' => false, 'message' => 'Invalid promo code']);
        }

        if ($subtotal < $promo->min_amount) {
            return response()->json(['success' => false, 'message' => 'Minimum order amount not met']);
        }

        $discount = floatval($promo->offer_amount) / 100 * floatval($subtotal);

        $newTotal = (float)$subtotal - (float)$discount + 60;

        return response()->json([
            'success' => true,
            'message' => 'Promo code applied successfully',
            'discount' => number_format($discount, 2),
            'new_total' => number_format($newTotal, 2)
        ]);
    }
}
