<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function userWishList(string $id)
    {
        // Fetch the wishlist for the specified user
        $wishlist = Wishlist::where('user_id', $id)
            ->with('product:id,image_path,name,price') // Select specific fields for the product
            ->get();
    
        // Map the wishlist items to include only required fields
        $wishlistItems = $wishlist->map(function ($item) {
            return [
                'id' => $item->product->id,
                'image_path' => 'http://egovision.shop/' . $item->product->image_path,
                'name' => $item->product->name,
                'price' => $item->product->price,
            ];
        });
    
        // Prepare the response
        return response()->json([
            'success' => true,
            'message' => 'Wishlist retrieved successfully.',
            'data' => $wishlistItems,
        ], 200); // OK
    }


    public function store(string $productId, string $userId)
    {

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
            'message' => 'Product added to your wishlist.'
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
