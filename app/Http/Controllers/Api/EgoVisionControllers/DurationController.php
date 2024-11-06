<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\Duration;
use App\Models\EgoModels\Product;
use App\Models\EgoModels\Wishlist;
use Illuminate\Http\Request;

class DurationController extends Controller
{
    public function getDurations()
    {
        $durations = Duration::select('id', 'name', 'months', 'is_month')->get();
    
        // Modify durations based on the is_month field
        $durations = $durations->map(function($duration) {
            if ($duration->is_month == 0) {
                // For is_month == 0, set the value of days to months directly
                $duration->days = $duration->months;
                unset($duration->months); // Optionally remove the months field
            }
            // No change for is_month == 1 (retain months)
            return $duration;
        });
    
        // Return the response based on whether durations are available or not
        if ($durations->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'success',
                'data' => $durations
            ]);
        } else {
            return response()->json([
                'status' => false,
                'response_code' => 404,
                'message' => 'Duration not found',
                'data' => []
            ]);
        }
    }
    
    

    public function getDurationPage()
    {
        $durations = Duration::select('id','name','months','image_path','description')->get();
        
        $formattedDurations = $durations->map(function ($duration) {
            $allowed_tags = '<br><p><strong><b><em><i><u><small><big><h1><h2><h3><h4><h5><h6><ul><ol><li><a><sub><sup>';
            return [
                'id' => $duration->id,
                'name' => $duration->name,
                'image_path' => $duration->image_path ? 'https://egovision.shop/' . $duration->image_path : null,
                'description' => strip_tags($duration->description, $allowed_tags)
            ];
        });
    
        // Check if colors exist and return a structured response
        if ($formattedDurations->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'success',
                'data' => $formattedDurations
            ]);
        } else {
            return response()->json([
                'status' => false,
                'response_code' => 404,
                'message' => 'Duration not found',
                'data' => []
            ]);
        }
        return response()->json($formattedDurations);
    }

    public function singleDuration(string $id, string $userId)
    {
        try {
            $duration = Duration::findOrFail($id);
    
            $productsPerPage = 18; // Adjust as necessary
    
            // Initialize the query for products related to the duration
            $productsQuery = Product::select('id', 'name', 'image_path', 'price')
                ->where('duration_id', $duration->id);
            
            // Add additional filters from request (e.g., color, base, diameter, tones, replacement, material, lens)
            $colorQueries = request()->query('colors');
            $colorArray = $colorQueries ? explode(',', $colorQueries) : [];
    
            $baseQueries = request()->query('base');
            $baseArray = $baseQueries ? explode(',', $baseQueries) : [];
    
            $diameterQueries = request()->query('diameter');
            $diameterArray = $diameterQueries ? explode(',', $diameterQueries) : [];
    
            $toneQueries = request()->query('tones');
            $toneArray = $toneQueries ? explode(',', $toneQueries) : [];
    
            $materialQueries = request()->query('material');
            $materialArray = $materialQueries ? explode(',', $materialQueries) : [];
    
            $lensQueries = request()->query('lens');
            $lensArray = $lensQueries ? explode(',', $lensQueries) : [];
    
            // Apply filters to the products query
            if (!empty($colorArray)) {
                $productsQuery->whereIn('color_id', $colorArray);
            }
    
            if (!empty($baseArray)) {
                $productsQuery->whereIn('base_curve_id', $baseArray);
            }
    
            if (!empty($diameterArray)) {
                $productsQuery->whereIn('diameter_id', $diameterArray);
            }
    
            if (!empty($toneArray)) {
                $productsQuery->whereIn('tone_id', $toneArray);
            }
    
            if (!empty($materialArray)) {
                $productsQuery->whereIn('material_id', $materialArray);
            }
    
            if (!empty($lensArray)) {
                $productsQuery->whereIn('lens_design_id', $lensArray);
            }
    
            // Paginate the products
            $products = $productsQuery->paginate($productsPerPage);
    
            // Format the product image paths and check for wishlist
            $formattedProducts = $products->getCollection()->map(function ($product) use ($userId) {
                $isWishlisted = Wishlist::where('user_id', $userId)
                    ->where('product_id', $product->id)
                    ->exists();
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image_path' => $product->image_path ? 'https://egovision.shop/' . $product->image_path : null,
                    'price' => $product->price,
                    'is_wishlisted' => $isWishlisted ? 1 : 0,
                ];
            });
    
            // Return a structured response
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'success',
                'duration_name' => $duration->name,
                'data' => [
                    'products' => $formattedProducts,
                    'product_count' => $products->total(), // Total number of products
                    'current_page' => $products->currentPage(), // Current page number
                    'last_page' => $products->lastPage(), // Total number of pages
                    'per_page' => $products->perPage(), // Items per page
                ],
            ]);
        } catch (\Exception $e) {
            // Catch and return error in case of exception
            return response()->json([
                'status' => false,
                'response_code' => 500,
                'message' => 'Server error: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }
    
}
