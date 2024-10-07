<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EgoModels\GiftCard;
use Carbon\Carbon;

class GiftCardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage Gift Cards';
        $giftCards = GiftCard::all();
        return view('admin.giftcard.index',compact('giftCards','pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Create Gift Cards';
        return view('admin.giftcard.create',compact('pageTitle'));
    }

    public function storeGiftCard(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:gift_cards,code',
            'balance' => 'required|numeric|min:1',
            'cutoff_percentage' => 'required|numeric|max:100',
            'expiry_date' => 'nullable|date|after:today',
        ]);
    
        GiftCard::create([
            'code' => $validatedData['code'],
            'balance' => $validatedData['balance'],
            'initial_balance' => $validatedData['balance'],
            'expiry_date' => $validatedData['expiry_date'] ?? null,
            'cutoff_percentage' => $validatedData['cutoff_percentage'] ?? null,
            'is_active' => true,
        ]);

        $notify[] = ['success','Gift card added successfully'];
    
        return redirect()->back()->with('message', 'Gift card created successfully.')->withNotify($notify);
    }

    public function edit(string $id)
    {
        $pageTitle = 'Edit Gift Card';
        $giftCard = GiftCard::find($id)->first();
        return view('admin.giftcard.edit',compact('pageTitle','giftCard'));
    }

    public function updateGiftCard(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:gift_cards,code',
            'balance' => 'required|numeric|min:1',
            'cutoff_percentage' => 'required|numeric|max:100',
            'expiry_date' => 'nullable|date|after:today',
        ]);

        $giftCard = GiftCard::where('id',$id)->first();
    
        $giftCard->update([
            'code' => $validatedData['code'],
            'balance' => $request['balance_now'],
            'initial_balance' => $validatedData['balance'],
            'expiry_date' => $validatedData['expiry_date'] ?? null,
            'cutoff_percentage' => $validatedData['cutoff_percentage'] ?? null,
            'is_active' => $request->status,
        ]);

        $notify[] = ['success','Gift card updated successfully'];
    
        return redirect()->back()->with('message', 'Gift card created successfully.')->withNotify($notify);
    }
    
    public function delete(string $id)
    {
        $giftCard = GiftCard::find($id);
        $notify[] = ['success','Gift card added successfully'];

        $giftCard->delete();

        return redirect()->back()->withNotify($notify);
    }

    public function search(Request $request)
    {
        $pageTitle = 'Gift Card';
    
        $request->validate([
            'code' => 'required|string',
        ]);
    
        $searchCode = $request->query('code'); // Retrieve 'code' from query string
    
        // Search for the gift card by code
        $giftCard = GiftCard::where('code', $searchCode)->first();
    
        // Check if a gift card was found
        if (!$giftCard) {
            return redirect()->route('ego.giftCard', ['code' => $searchCode])->with('error', 'Gift card not found.');
        }
    
        // Convert expiry_date to Carbon instance
        $giftCard->expiry_date = Carbon::parse($giftCard->expiry_date);
    
        // Pass the gift card and searchCode to the view using compact
        return view('user.gift_card', compact('giftCard', 'pageTitle'));
    }    
    
    
    
}
