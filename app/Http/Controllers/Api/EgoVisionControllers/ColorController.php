<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Color;
use App\Models\EgoModels\Product;
use App\Models\EgoModels\Wishlist;
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
    

    public function singleColor(string $id, string $userId)
    {
        try {
            $color = Color::findOrFail($id);
    
            $productsPerPage = 18;
    
            $productsQuery = Product::select('id', 'name', 'image_path', 'price')
                ->where('color_id', $color->id);
    
            $baseQueries = request()->query('base');
            $baseArray = $baseQueries ? explode(',', $baseQueries) : [];
    
            $diameterQueries = request()->query('diameter');
            $diameterArray = $diameterQueries ? explode(',', $diameterQueries) : [];
    
            $toneQueries = request()->query('tones');
            $toneArray = $toneQueries ? explode(',', $toneQueries) : [];
    
            $replacementQueries = request()->query('replacement');
            $replacementArray = $replacementQueries ? explode(',', $replacementQueries) : [];
    
            $materialQueries = request()->query('material');
            $materialArray = $materialQueries ? explode(',', $materialQueries) : [];
    
            $lensQueries = request()->query('lens');
            $lensArray = $lensQueries ? explode(',', $lensQueries) : [];
    
            if (!empty($baseArray)) {
                $productsQuery->whereIn('base_curve_id', $baseArray);
            }
    
            if (!empty($diameterArray)) {
                $productsQuery->whereIn('diameter_id', $diameterArray);
            }
    
            if (!empty($toneArray)) {
                $productsQuery->whereIn('tone_id', $toneArray);
            }
    
            if (!empty($replacementArray)) {
                $productsQuery->whereIn('duration_id', $replacementArray);
            }
    
            if (!empty($materialArray)) {
                $productsQuery->whereIn('material_id', $materialArray);
            }
    
            if (!empty($lensArray)) {
                $productsQuery->whereIn('lens_design_id', $lensArray);
            }
    
            $products = $productsQuery->paginate($productsPerPage);
    
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
    
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'success',
                'data' => [
                    'color_name' => $color->name,
                    'products' => $formattedProducts,
                    'product_count' => $products->total(),
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'response_code' => 500,
                'message' => 'Server error: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }
    
    
    
}
