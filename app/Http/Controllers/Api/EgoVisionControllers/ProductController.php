<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EgoModels\Product;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        try {
            // Set default items per page, you can also pass this as a query parameter
            $perPage = $request->query('per_page', 5); // Default to 10 items per page

            // Fetch products with pagination
            $products = Product::with(['color', 'lensDesign', 'baseCurve', 'category', 'replacement', 'tone', 'material', 'diameter', 'images'])
                ->select('id', 'name', 'price', 'image_path')
                ->paginate($perPage); // Use pagination instead of get()

            // Check if products exist
            if ($products->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'response_code' => 404,
                    'message' => 'No products found',
                    'data' => []
                ]);
            }

            // Format the product data
            $formattedProducts = $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'mainImage' => $product->image_path ? 'https://egovision.shop/' . $product->image_path : null
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
            $product = Product::with(['images:id,product_id,image_path', 'variations:id,product_id,power,stock'])->findOrFail($id);

            // Remove HTML tags from 'product_intro' and 'description'
            $product->product_intro = strip_tags($product->product_intro);
            $product->description = strip_tags($product->description);

            // Format the main image path
            $product->image_path = $product->image_path ? 'https://egovision.shop/' . $product->image_path : null;

            // Filter the images to include only 'id' and 'image_path' with the correct prefix
            $product->images = $product->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'image_path' => !empty($image->image_path) ? 'https://egovision.shop/' . $image->image_path : null,
                ];
            });

            // Filter the variations to include only 'id', 'power', and 'stock'
            $product->variations = $product->variations->map(function ($variation) {
                return [
                    'id' => $variation->id,
                    'power' => $variation->power,
                    'stock' => $variation->stock,
                ];
            });

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
