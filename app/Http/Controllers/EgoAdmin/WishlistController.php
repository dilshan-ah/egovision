<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){

    }

    public function store(string $productId)
    {
        // Get the authenticated user's ID
        $userId = Auth::id();  
    
        // Check if the product is already in the user's wishlist
        $existingWishlistItem = Wishlist::where('user_id', $userId)
                                         ->where('product_id', $productId)
                                         ->first();
    
        if ($existingWishlistItem) {
            $existingWishlistItem->delete();
            return redirect()->back()->with(['message' => 'Product is already in your wishlist'], 200);
        }
    
        // Create a new wishlist entry
        $wishlist = new Wishlist();
        $wishlist->user_id = $userId;
        $wishlist->product_id = $productId;
    
        // Save the wishlist entry
        $wishlist->save();
    
        return redirect()->route('ego.wishlist');
    }

    public function delete(string $id)
    {
        $wishlist = Wishlist::find($id);

        $wishlist->delete();

        return redirect()->back();
    }
}
