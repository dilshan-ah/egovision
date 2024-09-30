<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Color;
use App\Models\EgoModels\Product;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function getDashColor()
    {
        // Fetch colors from the database
        $colors = Color::select('id', 'name', 'image_path')->get();
    
        // Format the colors with the correct URL prefix for image_path
        $formattedColors = $colors->map(function ($color) {
            return [
                'id' => $color->id,
                'name' => $color->name,
                'image_path' => $color->image_path ? 'https://egovision.shop/' . $color->image_path : null
            ];
        });
    
        // Check if colors exist and return a structured response
        if ($formattedColors->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'success',
                'data' => $formattedColors
            ]);
        } else {
            return response()->json([
                'status' => false,
                'response_code' => 404,
                'message' => 'Colors not found',
                'data' => []
            ]);
        }
    }

    public function getPageColor()
    {
        $colors = Color::all();
    
        // Format the colors with the correct URL prefix for image_path
        $formattedColors = $colors->map(function ($color) {
            return [
                'id' => $color->id,
                'name' => $color->name,
                'image_path' => $color->image_path ? 'https://egovision.shop/' . $color->image_path : null,
                'color_intro' => strip_tags($color->color_intro)
            ];
        });
    
        // Check if colors exist and return a structured response
        if ($formattedColors->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'success',
                'data' => $formattedColors
            ]);
        } else {
            return response()->json([
                'status' => false,
                'response_code' => 404,
                'message' => 'Colors not found',
                'data' => []
            ]);
        }
    }
    

    public function singleColor(string $id)
    {
        try {
            // Fetch color by ID
            $color = Color::findOrFail($id);
    
            // Set the number of products per page
            $productsPerPage = 10; // Adjust as necessary
    
            // Fetch products related to the color with pagination
            $productsQuery = Product::select('id', 'name', 'image_path', 'price')
                ->where('color_id', $color->id);
            
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
                'data' => [
                    'color_name' => $color->name,
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
