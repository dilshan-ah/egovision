<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Color;
use App\Models\EgoModels\Product;
use App\Models\EgoModels\LensDesign;
use App\Models\EgoModels\BaseCurve;
use App\Models\EgoModels\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateProductRequest;
use App\Models\Duration;
use App\Models\EgoModels\Diameter;
use App\Models\EgoModels\Material;
use App\Models\EgoModels\ProductImage;
use App\Models\EgoModels\Replacement;
use App\Models\EgoModels\Tone;
use App\Models\EgoModels\LensPower;
use App\Models\EgoModels\ProductVariation;
// use App\Models\EgoModels\WaterContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $pageTitle = "Product List";
        $products = Product::where('product_type','normal')->with(['category', 'color', 'images'])->get();
        return view('ego.ego-admin.products.index', compact('pageTitle', 'products'));
    }

    public function allAccessories()
    {
        $pageTitle = "Accessory List";
        $products = Product::where('product_type','accessories')->with(['category', 'color', 'images'])->get();
        return view('ego.ego-admin.products.accessories', compact('pageTitle', 'products'));
    }

    public function create()
    {
        $pageTitle = "Add Lens";
        $colors = Color::all();
        $categories = ProductCategory::all();
        $diameters = Diameter::all();
        $replacements = Replacement::all();
        $materials = Material::all();
        $tones = Tone::all();
        $bases = BaseCurve::all();
        $lDesigns = LensDesign::all();
        $durations = Duration::all();
        // $water_contents = WaterContent::all();
        $lensPowers = LensPower::all();
        return view(
            'ego.ego-admin.products.create',
            compact(
                'pageTitle',
                'colors',
                'categories',
                'diameters',
                'replacements',
                'materials',
                'tones',
                'bases',
                'lDesigns',
                'durations',
                'lensPowers'
                // 'water_contents'
            )
        );
    }

    public function createAccessories()
    {
        $pageTitle = "Add Accessories";
        $colors = Color::all();
        $categories = ProductCategory::all();
        $diameters = Diameter::all();
        $replacements = Replacement::all();
        $materials = Material::all();
        $tones = Tone::all();
        $bases = BaseCurve::all();
        $lDesigns = LensDesign::all();
        $durations = Duration::all();
        // $water_contents = WaterContent::all();
        $lensPowers = LensPower::all();
        return view(
            'ego.ego-admin.products.create_accessories',
            compact(
                'pageTitle',
                'colors',
                'categories',
                'diameters',
                'replacements',
                'materials',
                'tones',
                'bases',
                'lDesigns',
                'durations',
                'lensPowers'
            )
        );
    }

    public function store(ValidateProductRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();

        try {
            $product = new Product;
            $product->name = $validated['name'];
            $product->product_intro = $validated['product_intro'];
            $product->description = $validated['description'];
            $product->pack_content = $validated['pack_content'];
            $product->diameter_id = $validated['diameter_id'];
            $product->base_curve_id = $validated['base_curve_id'];
            $product->material_id = $validated['material_id'];
            $product->water_content = $validated['water_content_id'];
            $product->tone_id = $validated['tone_id'];
            $product->lens_design_id = $validated['lens_design_id'];
            $product->stock_quantity = $validated['stock_quantity'];
            $product->price = $validated['price'];
            $product->color_id = $validated['color_id'];
            $product->category_id = $validated['category_id'];
            $product->duration_id = $validated['duration_id'];
            $product->product_type = 'normal';

            if ($request->hasFile('product_image')) {
                $validated['product_image'] = $this->handleFileUpload($request->file('product_image'), 'ego-assets/images/products', 'Product');
                $product->image_path = $validated['product_image'];
            }

            $product->save();

            if ($request->hasFile('product_image_album')) {
                $images = $request->file('product_image_album');
                foreach ($images as $image) {
                    $imagePath = $this->handleFileUpload($image, 'ego-assets/images/product_images', 'ProductImage');
                    $productImage = new ProductImage;
                    $productImage->product_id = $product->id;
                    $productImage->image_path = $imagePath;
                    $productImage->save();
                }
            }

            $variationsJson = $request->input('variations_json');

            $variations = json_decode($variationsJson, true);

            foreach ($variations as $variation) {
                $productVariation = new ProductVariation();

                $productVariation->product_id = $product->id;
                $productVariation->power = $variation['power'];
                $productVariation->stock = $variation['stock'];

                $productVariation->save();
            }

            DB::commit();

            $notify[] = ['success', 'Product added successfully.'];
            return to_route('product.index')->withNotify($notify);
        } catch (\Exception $e) {
            DB::rollBack();
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
    }

    public function storeAccessories(Request $request)
    {
        DB::beginTransaction();

        try {
            $product = new Product;
            $product->name = $request['name'];
            $product->product_intro = $request['product_intro'];
            $product->description = $request['description'];
            $product->pack_content = $request['pack_content'];
            $product->diameter_id = $request['diameter_id'];
            $product->base_curve_id = $request['base_curve_id'];
            $product->stock_quantity = $request['stock_quantity'];
            $product->price = $request['price'];
            $product->duration_id = $request['duration_id'];
            $product->product_type = 'accessories';

            if ($request->hasFile('product_image')) {
                $validated['product_image'] = $this->handleFileUpload($request->file('product_image'), 'ego-assets/images/products', 'Product');
                $product->image_path = $validated['product_image'];
            }

            $product->save();

            if ($request->hasFile('product_image_album')) {
                $images = $request->file('product_image_album');
                foreach ($images as $image) {
                    $imagePath = $this->handleFileUpload($image, 'ego-assets/images/product_images', 'ProductImage');
                    $productImage = new ProductImage;
                    $productImage->product_id = $product->id;
                    $productImage->image_path = $imagePath;
                    $productImage->save();
                }
            }

            DB::commit();

            $notify[] = ['success', 'Product added successfully.'];
            return to_route('product.index')->withNotify($notify);
        } catch (\Exception $e) {
            DB::rollBack();
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
    }

    public function update(ValidateProductRequest $request, $id)
    {
        $validated = $request->validated();
        DB::beginTransaction();

        try {
            // Find the product to update
            $product = Product::findOrFail($id);

            // Update product details
            $product->name = $validated['name'];
            $product->product_intro = $validated['product_intro'];
            $product->description = $validated['description'];
            $product->pack_content = $validated['pack_content'];
            $product->diameter_id = $validated['diameter_id'];
            $product->base_curve_id = $validated['base_curve_id'];
            $product->material_id = $validated['material_id'];
            $product->water_content = $validated['water_content_id'];
            $product->tone_id = $validated['tone_id'];
            $product->lens_design_id = $validated['lens_design_id'];
            $product->stock_quantity = $validated['stock_quantity'];
            $product->price = $validated['price'];
            $product->color_id = $validated['color_id'];
            $product->category_id = $validated['category_id'];
            $product->duration_id = $validated['duration_id'];
            $product->product_type = $validated['product_type'];

            // Handle product image replacement
            if ($request->hasFile('product_image')) {
                // Delete the old image if exists
                if ($product->image_path && File::exists(public_path($product->image_path))) {
                    File::delete(public_path($product->image_path));
                }
                $validated['product_image'] = $this->handleFileUpload($request->file('product_image'), 'ego-assets/images/products', 'Product');
                $product->image_path = $validated['product_image'];
            }

            // Save the updated product
            $product->save();

            // Handle product image album replacement
            if ($request->hasFile('product_image_album')) {
                // Delete old album images
                ProductImage::where('product_id', $product->id)->get()->each(function ($image) {
                    if (File::exists(public_path($image->image_path))) {
                        File::delete(public_path($image->image_path));
                    }
                    $image->delete();
                });

                // Add new album images
                $images = $request->file('product_image_album');
                foreach ($images as $image) {
                    $imagePath = $this->handleFileUpload($image, 'ego-assets/images/product_images', 'ProductImage');
                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_path = $imagePath;
                    $productImage->save();
                }
            }

            // Handle variations update
            $variationsJson = $request->input('variations_json');
            $variations = json_decode($variationsJson, true);

            // First, delete the existing variations
            ProductVariation::where('product_id', $product->id)->delete();

            // Now, add the new variations
            foreach ($variations as $variation) {
                $productVariation = new ProductVariation();
                $productVariation->product_id = $product->id;
                $productVariation->power = $variation['power'];
                $productVariation->stock = $variation['stock'];
                $productVariation->save();
            }

            DB::commit();

            $notify[] = ['success', 'Product updated successfully.'];
            return to_route('product.index')->withNotify($notify);
        } catch (\Exception $e) {
            DB::rollBack();
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
    }


    private function handleFileUpload($file, $destinationPath, $modelName)
    {
        $extension = $file->extension();
        $imageName = $this->generateUniqueImageName($extension, $destinationPath, $modelName);
        $file->move(public_path($destinationPath), $imageName);
        return $destinationPath . '/' . $imageName;
    }

    private function generateUniqueImageName($extension, $destinationPath, $modelName)
    {
        do {
            $randomNumber = mt_rand(100000, 999999);
            $imageName = $randomNumber . '.' . $extension;
            $existingRecord = app("App\\Models\EgoModels\\$modelName")->where('image_path', $destinationPath . '/' . $imageName)->first();
        } while ($existingRecord || File::exists(public_path($destinationPath . '/' . $imageName)));
        return $imageName;
    }

    public function edit($id)
    {
        $pageTitle = "Color Edit";
        $colors = Color::all();
        $categories = ProductCategory::all();
        $diameters = Diameter::all();
        $replacements = Replacement::all();
        $materials = Material::all();
        $tones = Tone::all();
        $bases = BaseCurve::all();
        $lDesigns = LensDesign::all();
        $durations = Duration::all();
        $lensPowers = LensPower::all();

        $product = Product::findOrFail($id);
        return view('ego.ego-admin.products.edit', compact('pageTitle', 'product','colors',
                'categories',
                'diameters',
                'replacements',
                'materials',
                'tones',
                'bases',
                'lDesigns',
                'durations',
                'lensPowers'));
    }

    // public function update(Request $request, $id)
    // {
    //     $color = Color::findOrFail($id);
    //     $request->validate([
    //         'name' => [
    //             'required',
    //             'string',
    //             'max:255',
    //             Rule::unique('product_categories')->ignore($id),
    //         ],
    //     ], [
    //         'name.required' => 'The color field is required.'
    //     ]);
    //     $color->name = $request->input('name');
    //     $color->save();

    //     $notify[] = ['success', 'Color updated successfully.'];
    //     return redirect()->route('color.index')->withNotify($notify);
    // }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $notify[] = ['success', 'Product deleted.'];
        return redirect()->back()->withNotify($notify);
    }
}
