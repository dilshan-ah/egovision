<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EgoModels\Product;
use App\Models\EgoModels\Wishlist;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function getProducts(Request $request, string $userId)
    {
        
        try {
            // Set default items per page, you can also pass this as a query parameter
            $perPage = $request->query('per_page', 18);
    
            // Fetch products with pagination
            $products = Product::with(['color', 'lensDesign', 'baseCurve', 'category', 'tone', 'material', 'diameter', 'images'])
                ->where('product_type', 'normal')
                ->select('id', 'name', 'price', 'image_path')
                ->paginate($perPage);
    
            // Check if products exist
            if ($products->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'response_code' => 404,
                    'message' => 'No products found',
                    'data' => []
                ]);
            }
    
            // Format the product data and pass $userId to the map closure
            $formattedProducts = $products->map(function ($product) use ($userId) {
                
                $isWishlisted = Wishlist::where('user_id', $userId)
                    ->where('product_id', $product->id)
                    ->exists();


    
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'mainImage' => $product->image_path ? 'https://egovision.shop/' . $product->image_path : null,
                    'is_wishlisted' => $isWishlisted ? 1 : 0,
                ];
            });
    
            // Return success response with pagination info
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'success',
                'data' => $formattedProducts,
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'last_page' => $products->lastPage(),
                ]
            ]);
        } catch (\Exception $e) {
            // Catch and return any potential errors during fetching
            return response()->json([
                'status' => false,
                'response_code' => 500,
                'message' => 'Server error: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }
    

    public function singleProduct(string $id)
    {
        try {
            // Fetch product by ID along with its related images and variations
            $product = Product::with(['images:id,product_id,image_path'])->findOrFail($id);

            // Remove HTML tags from 'product_intro' and 'description'
            $product->product_intro = strip_tags($product->product_intro);
            $product->description = strip_tags($product->description);

            // Format the main image path
            $product->image_path = $product->image_path ? 'https://egovision.shop/' . $product->image_path : null;

            $product->images = $product->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'image_path' => $image->image_path ? 'https://egovision.shop/' . $image->image_path : null,
                ];
            });

            $availablePowers = json_decode($product->available_powers) ?? [];
            $powers = $this->generatePowerValues($availablePowers);

            $product->available_powers = $powers;

            // Return success response with the formatted product data
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'success',
                'data' => $product
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

    public function generatePowerValues($availablePowers) {
        $values = [];
    
        foreach ($availablePowers as $range) {
            // Extract the numbers from the range string
            preg_match_all('/-?\d+\.?\d*/', $range, $matches);
    
            if (count($matches[0]) == 2) {
                $start = floatval($matches[0][0]);
                $end = floatval($matches[0][1]);

                // dd($end);
    
                // Determine the interval based on the range
                if ($range === '(-0.25-6.00)' || $range === '(+0.25+6.00)' ) {
                    $interval = 0.25;
                } elseif ($range === '(-6.50-10.00)' || $range === '(+6.50+10.00)') {
                    $interval = 0.50;
                } else {
                    continue;
                }
    
                if($start > 0)
                {
                    for ($value = $start; $value <= $end; $value += $interval) {
                        $values[] = round($value, 2);
                    }
                }else{
                    for ($value = $start; $value >= $end; $value -= $interval) {
                        $values[] = round($value, 2);
                    }
                }

            }
        }
    
        return $values;
    }

    public function getAccessories(Request $request)
    {
        // Define the number of items per page
        $perPage = $request->input('per_page', 10); // Default to 10 if not provided

        // Fetch the accessories with pagination, selecting specific fields
        $products = Product::where('product_type', 'accessories')
            ->select('id', 'image_path', 'name', 'price') // Select specific fields
            ->paginate($perPage);

        // Customize the pagination response
        $customResponse = [
            'success' => true,
            'message' => 'Accessories retrieved successfully.',
            'data' => $products->getCollection()->map(function ($item) {
                // Add the base URL prefix to the image path
                $item->image_path = 'https://egovision.shop/' . $item->image_path;
                return $item;
            }),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'total' => $products->total(),
            'per_page' => $products->perPage(),
        ];

        return response()->json($customResponse, 200); // OK
    }
}
