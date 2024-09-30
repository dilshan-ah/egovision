<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Product;
use App\Models\EgoModels\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory()
    {
        $categories = ProductCategory::select('id', 'name', 'thumbnail', 'description')->get();

        $categories = $categories->map(function ($category) {
            $category->description = strip_tags($category->description);
            return $category;
        });

        if ($categories->isNotEmpty()) {
            return response()->json($categories);
        } else {
            return response()->json(['message' => 'Categories not found'], 404);
        }
    }

    public function singleCategory(string $id)
    {
        $category = ProductCategory::findOrFail($id);
        $products = Product::select('id', 'name', 'image_path', 'price')->where('category_id', $category->id)->get();

        if ($products) {
            return response()->json($products);
        } else {
            return response()->json(['message' => 'Products not found'], 404);
        }
    }
}
