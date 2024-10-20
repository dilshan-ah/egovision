<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\CollectionSet;
use App\Models\EgoModels\Product;
use App\Models\EgoModels\Wishlist;
use Illuminate\Http\Request;

class CollectionSetController extends Controller
{
    public function collectionMenu()
    {
        try {
            // Fetch the collection sets with only the required fields for category, tone, and duration
            $collectionSets = CollectionSet::with([
                'category:id,name',
                'tone:id,name',
                'duration:id,name'
            ])
                ->get(['id', 'category_id', 'tone_id', 'duration_id']);

            // Check if any collection sets are found
            if ($collectionSets->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'response_code' => 404,
                    'message' => 'No featured collection sets found',
                    'data' => []
                ]);
            }

            // Prepare an array to hold the formatted collection sets
            $formattedCollectionSets = [];

            // Iterate through each collection set and attach related products
            foreach ($collectionSets as $collectionSet) {
                // Initialize the query for products
                $productsQuery = Product::select('id', 'name');

                // Add category filter (mandatory)
                $productsQuery->where('category_id', $collectionSet->category_id);

                // Add tone filter if tone_id exists
                if ($collectionSet->tone_id) {
                    $productsQuery->where('tone_id', $collectionSet->tone_id);
                }

                // Add duration filter if duration_id exists
                if ($collectionSet->duration_id) {
                    $productsQuery->where('duration_id', $collectionSet->duration_id);
                }

                // Fetch the products that match the query
                $products = $productsQuery->get();

                // Attach products as a child object (keep as objects, no conversion to array)
                $collectionSet->products = $products;

                // Add formatted collection set to the array
                $formattedCollectionSets[] = [
                    'id' => $collectionSet->id,
                    'products' => $collectionSet->products,
                    'category_name' => $collectionSet->category->name ?? null,
                    'tone_name' => $collectionSet->tone->name ?? null,
                    'duration_name' => $collectionSet->duration->name ?? null,
                ];
            }

            // Return success response with formatted data
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'Featured collection sets fetched successfully',
                'data' => $formattedCollectionSets // Returning the formatted collection sets
            ]);
        } catch (\Exception $e) {
            // Return error response in case of an exception
            return response()->json([
                'status' => false,
                'response_code' => 500,
                'message' => 'Server error: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function collectionPage()
    {
        try {
            // Fetch the collection sets with only the required fields for category, tone, and duration
            $collectionSets = CollectionSet::with([
                'category:id,name',
                'tone:id,name',
                'duration:id,name'
            ])
                ->get(['id', 'category_id', 'tone_id', 'duration_id', 'image_path', 'description']);

            // Check if any collection sets are found
            if ($collectionSets->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'response_code' => 404,
                    'message' => 'No featured collection sets found',
                    'data' => []
                ]);
            }

            // Prepare an array to hold the formatted collection sets
            $formattedCollectionSets = [];

            // Iterate through each collection set and attach related products
            foreach ($collectionSets as $collectionSet) {


                // Add formatted collection set to the array
                $formattedCollectionSets[] = [
                    'id' => $collectionSet->id,
                    'image_path' => 'https://egovision.shop/'.$collectionSet->image_path, // Include image_path from collection set
                    'description' => strip_tags($collectionSet->description), // Stripped description 
                    'category_name' => $collectionSet->category->name ?? null,
                    'tone_name' => $collectionSet->tone->name ?? null,
                    'duration_name' => $collectionSet->duration->name ?? null,
                ];
            }

            // Return success response with formatted data
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'Featured collection sets fetched successfully',
                'data' => $formattedCollectionSets // Returning the formatted collection sets
            ]);
        } catch (\Exception $e) {
            // Return error response in case of an exception
            return response()->json([
                'status' => false,
                'response_code' => 500,
                'message' => 'Server error: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function singleCollection(string $id, string $userId)
    {
        try {
            // Fetch the collection set with related category, tone, and duration
            $collectionSet = CollectionSet::with(['category:id,name', 'tone:id,name', 'duration:id,name'])
                ->where('id', $id)
                ->firstOrFail(['id', 'category_id', 'tone_id', 'duration_id', 'image_path', 'description']);
        
            // Initialize the query for products with pagination
            $productsPerPage = 10;
            $productsQuery = Product::select('id', 'name', 'image_path', 'price');
        
            // Add category filter (mandatory)
            $productsQuery->where('category_id', $collectionSet->category_id);
        
            // Add tone and duration filters
            if ($collectionSet->tone_id) {
                $productsQuery->where('tone_id', $collectionSet->tone_id);
            }
            if ($collectionSet->duration_id) {
                $productsQuery->where('duration_id', $collectionSet->duration_id);
            }
        
            // Fetch the products with pagination
            $products = $productsQuery->paginate($productsPerPage);
        
            // Add prefix to image_path for each product and check for wishlist
            $prefix = 'https://egovision.shop/';
        
            foreach ($products as $product) {
                $product->image_path = $prefix . $product->image_path;
        
                $isWishlisted = Wishlist::where('user_id', $userId)
                    ->where('product_id', $product->id)
                    ->exists();
        
                $product->is_wishlisted = $isWishlisted ? 1 : 0;
            }
        
            // Format the response data
            $responseData = [
                'id' => $collectionSet->id,
                'category_name' => $collectionSet->category->name ?? null,
                'tone_name' => $collectionSet->tone->name ?? null,
                'duration_name' => $collectionSet->duration->name ?? null,
                'products' => $products->items(),
                'product_count' => $products->total(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
            ];
        
            // Return success response
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'Collection set fetched successfully',
                'data' => $responseData
            ]);
        } catch (\Exception $e) {
            // Return error response in case of an exception
            return response()->json([
                'status' => false,
                'response_code' => 500,
                'message' => 'Server error: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }
    

    public function featuredCollection()
    {
        try {
            // Fetch the collection sets with related category, tone, and duration
            $collectionSets = CollectionSet::with(['category:id,name', 'tone:id,name', 'duration:id,name'])
                ->where('featured', 'yes')
                ->get(['id', 'category_id', 'tone_id', 'duration_id']);
    
            // Initialize an array to hold the formatted data
            $formattedCollectionSets = [];
    
            foreach ($collectionSets as $collectionSet) {
                // Initialize the query for products
                $productsQuery = Product::select('id', 'name', 'image_path', 'price');
    
                // Add category filter (this is mandatory)
                $productsQuery->where('category_id', $collectionSet->category_id);
    
                // Add tone filter if tone_id exists
                if ($collectionSet->tone_id) {
                    $productsQuery->where('tone_id', $collectionSet->tone_id);
                }
    
                // Add duration filter if duration_id exists
                if ($collectionSet->duration_id) {
                    $productsQuery->where('duration_id', $collectionSet->duration_id);
                }
    
                // Fetch the products that match the query
                $products = $productsQuery->get();
    
                // Add prefix to image_path for each product
                $prefix = 'https://egovision.shop/'; // Set your desired prefix here
                foreach ($products as $product) {
                    $product->image_path = $prefix . $product->image_path; // Add the prefix
                }
    
                // Format the collection set with required fields and products
                $formattedCollectionSets[] = [
                    'id' => $collectionSet->id,
                    'category_name' => $collectionSet->category->name ?? null,
                    'tone_name' => $collectionSet->tone->name ?? null,
                    'duration_name' => $collectionSet->duration->name ?? null,
                    'products' => $products->map(function ($product) {
                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'image' => $product->image_path,
                            'price' => $product->price,
                        ];
                    }),
                ];
            }
    
            // Return the formatted response
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'Featured collection sets fetched successfully',
                'data' => $formattedCollectionSets,
            ]);
        } catch (\Exception $e) {
            // Return error response in case of an exception
            return response()->json([
                'status' => false,
                'response_code' => 500,
                'message' => 'Server error: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function moreProducts()
    {
        try {
            // Fetch products with related color, category, and collectionSet that is not featured
            $products = Product::with([
                'color',
                'category.collectionSet' => function ($query) {
                    $query->where('featured', '!=', 'yes');
                }
            ])->take(10)->get();
    
            $filteredProducts = $products->filter(function ($product) {
                return $product->category && $product->category->collectionSet && $product->category->collectionSet->featured != 'yes';
            });
    
            // Format the filtered products
            $responseProducts = $filteredProducts->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image_path' => $product->image_path ? 'https://egovision.shop/' . $product->image_path : null, // Add prefix to image_path
                    'price' => $product->price,
                ];
            });
    
            // Return success response
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'Products fetched successfully',
                'data' => $responseProducts
            ]);
        } catch (\Exception $e) {
            // Return error response in case of an exception
            return response()->json([
                'status' => false,
                'response_code' => 500,
                'message' => 'Server error: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }
    
    
    
    
}
