<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\InstagramPost;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    public function getAllInstagramPosts()
    {
        $instaPosts = InstagramPost::all();
        $postsWithDetails = [];
    
        foreach ($instaPosts as $instaPost) {
            // Fetch post details from the Instagram API using the `post()` method in the model
            $postDetails = $instaPost->post();
    
            // Handle product details (whether a product is linked or not)
            $product = $instaPost->product;
            $productDetails = $product ? [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->image_path ?? 'No image available',
            ] : [
                'product_id' => 'No associated product',
                'product_name' => 'No associated product',
                'product_image' => 'No associated product',
            ];
    
            // Handle Instagram post details (whether the API request is successful or not)
            $postDetailsArray = $postDetails ? [
                'post_id' => $postDetails['id'] ?? 'No post ID',
                'caption' => $postDetails['caption'] ?? 'No caption',
                'media_type' => $postDetails['media_type'] ?? 'No media type',
                'media_url' => $postDetails['media_url'] ?? 'No media URL',
                'permalink' => $postDetails['permalink'] ?? 'No permalink',
                'timestamp' => $postDetails['timestamp'] ?? 'No timestamp',
                'like_count' => 0,
                'comment_count' => 0,
            ] : [
                'post_id' => 'No post available',
                'caption' => 'No caption available',
                'media_type' => 'No media type',
                'media_url' => 'No media URL',
                'permalink' => 'No permalink',
                'timestamp' => 'No timestamp',
            ];
    
            // Append the Instagram post and product information
            $postsWithDetails[] = [
                'id' => $instaPost->id,
                'insta_user' => $instaPost->user->name ?? 'Unknown',
                'post_details' => $postDetailsArray,
                'product_details' => $productDetails,
                'color_id' => $product->color->id ?? 'No associated color',
                'color_name' => $product->color->name ?? 'No associated color',
            ];
        }
    
        // Return the full response as JSON
        return response()->json([
            'success' => true,
            'message' => 'Instagram posts fetched successfully',
            'data' => $postsWithDetails,
        ]);
    }
    
    
}
