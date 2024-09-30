<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function getBanners()
    {
        $banners = Banner::all();

        if ($banners) {
            return response()->json($banners);
        } else {
            return response()->json(['message' => 'Banner not found'], 404);
        }
    }

    public function getBannerForApp()
    {
        // Fetch banners from the database
        $banners = Banner::select('id', 'banner_path', 'product_id')->get();
    
        // Format the banners with the correct URL prefix
        $formattedBanners = $banners->map(function ($banner) {
            return [
                'id' => $banner->id,
                'product_id' => $banner->product_id,
                'banner_path' => $banner->banner_path ? 'https://egovision.shop/' . $banner->banner_path : null
            ];
        });
    
        // Check if banners exist and return a structured response
        if ($formattedBanners->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'success',
                'data' => $formattedBanners
            ]);
        } else {
            return response()->json([
                'status' => false,
                'response_code' => 404,
                'message' => 'Banner not found',
                'data' => []
            ]);
        }
    }
    
}
