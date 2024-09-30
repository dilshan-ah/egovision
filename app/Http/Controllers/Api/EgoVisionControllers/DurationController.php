<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\Duration;
use App\Models\EgoModels\Product;
use Illuminate\Http\Request;

class DurationController extends Controller
{
    public function getDurations()
    {
        $durations = Duration::select('id','name','months')->get();

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

        return response()->json($durations);
    }

    public function getDurationPage()
    {
        $durations = Duration::select('id','name','months','image_path','description')->get();
        
        $formattedDurations = $durations->map(function ($duration) {
            return [
                'id' => $duration->id,
                'name' => $duration->name,
                'image_path' => $duration->image_path ? 'https://egovision.shop/' . $duration->image_path : null,
                'description' => strip_tags($duration->description)
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

    public function singleDuration(string $id)
    {
        try {
            // Fetch color by ID
            $duration = Duration::findOrFail($id);
    
            // Set the number of products per page
            $productsPerPage = 10; // Adjust as necessary
    
            // Fetch products related to the color with pagination
            $productsQuery = Product::select('id', 'name', 'image_path', 'price')
                ->where('duration_id', $duration->id);
            
            // Paginate the products
            $products = $productsQuery->paginate($productsPerPage);
    
            // Format the product image paths
            $formattedProducts = $products->getCollection()->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image_path' => $product->image_path ? 'https://egovision.shop/' . $product->image_path : null,
                    'price' => $product->price,
                ];
            });
    
            // Check if products exist and return a structured response
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
