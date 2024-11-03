<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Product;
use App\Models\EgoModels\Wishlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    public function userWishList(string $id)
    {
        $wishlist = Wishlist::where('user_id', $id)
            ->with('product:id,image_path,name,price')
            ->get();
    
        if ($wishlist->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No Product found in wishlist'
            ], 404); 
        }
    
        $wishlistItems = $wishlist->map(function ($item) {
            if ($item->product) {
                return [
                    'id' => $item->product->id,
                    'image_path' => 'http://egovision.shop/' . $item->product->image_path,
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                ];
            }
            return null;
        })->filter();
        
        return response()->json([
            'success' => true,
            'message' => 'Wishlist retrieved successfully.',
            'data' => $wishlistItems->values(),
        ], 200); // OK
    }

    public function store(string $productId, string $userId)
    {
        // Check if the user exists
        $userExists = User::find($userId);
        if (!$userExists) {
            return response()->json([
                'success' => false,
                'message' => 'User does not exist.'
            ], 400); // Bad Request
        }
    
        // Check if the product exists
        $productExists = Product::find($productId);
        if (!$productExists) {
            return response()->json([
                'success' => false,
                'message' => 'Product does not exist.'
            ], 400); // Bad Request
        }
    
        // Check if the product is already in the user's wishlist
        $existingWishlistItem = Wishlist::where('user_id', $userId)
                                        ->where('product_id', $productId)
                                        ->first();
    
        if ($existingWishlistItem) {
            $existingWishlistItem->delete();
            return response()->json([
                'success' => true,
                'message' => 'Product removed from your wishlist.'
            ], 200); // OK
        }
    
        // Create a new wishlist entry
        $wishlist = new Wishlist();
        $wishlist->user_id = $userId;
        $wishlist->product_id = $productId;
    
        // Save the wishlist entry
        $wishlist->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Product added to your wishlist.',
            'wishlist_count'=> Wishlist::where('user_id',$userExists->id)->count()
        ], 201); // Created
    }
    

    public function delete(string $id)
    {
        $wishlist = Wishlist::find($id);

        if (!$wishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Wishlist item not found.'
            ], 404);
        }

        $wishlist->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product removed from your wishlist.'
        ], 200);
    }
    
}
