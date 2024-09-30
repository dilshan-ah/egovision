<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\CollectionSet;
use App\Models\Duration;
use App\Models\EgoModels\BaseCurve;
use App\Models\EgoModels\Color;
use App\Models\EgoModels\Diameter;
use App\Models\EgoModels\LensDesign;
use App\Models\EgoModels\Material;
use App\Models\EgoModels\Product;
use App\Models\EgoModels\ProductCategory;
use App\Models\EgoModels\Tone;
use Illuminate\Http\Request;
use SendGrid\Mail\Category;

class CollectionSetController extends Controller
{
    public function index()
    {
        $pageTitle = "Collection Set";
        $collectionSets = CollectionSet::all();

        return view('ego.ego-admin.collectionSet.index',compact('pageTitle','collectionSets'));
    }

    public function create()
    {
        $pageTitle = "Create Collection Set";
        $categories = ProductCategory::all();
        $tones = Tone::all();
        $durations = Duration::all();
        return view('ego.ego-admin.collectionSet.create', compact('pageTitle','categories','tones','durations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|string|max:255',
        ]);
        try {
            $collectionSet = new CollectionSet();
            $collectionSet->category_id = $request->category_id;
            $collectionSet->tone_id = $request->tone_id;
            $collectionSet->duration_id = $request->duration_id;
            $collectionSet->featured = $request->featured;

            $collectionSet->description = $request->collection_description;

            if ($request->hasFile('collection_image')) {
                try {
                    $image = $request->file('collection_image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('ego-assets/images/product_collections'), $imageName);
                    $imageName = 'ego-assets/images/product_collections/' . $imageName;
                    $collectionSet->image_path = $imageName;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Failed to upload file');
                }
            }

            $collectionSet->save();

            $notify[] = ['success', 'Collection set created successfully.'];
            return redirect()->route('collectionSet.view')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit(string $id)
    {
        $collectionSet = CollectionSet::findOrFail($id);
        $pageTitle = $collectionSet->category->name;

        if ($collectionSet->tone) {
            $pageTitle .= ' - ' . $collectionSet->tone->name;
        }

        if ($collectionSet->duration) {
            $pageTitle .= ' - ' . $collectionSet->duration->name;
        }

        $categories = ProductCategory::all();
        $tones = Tone::all();
        $durations = Duration::all();
        return view('ego.ego-admin.collectionSet.edit',compact('collectionSet','pageTitle','categories','tones','durations'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required|string|max:255',
        ]);

        try {
            $collectionSet = CollectionSet::findOrFail($id);
            $collectionSet->category_id = $request->category_id;
            $collectionSet->tone_id = $request->tone_id;
            $collectionSet->duration_id = $request->duration_id;
            $collectionSet->featured = $request->featured;

            $collectionSet->description = $request->collection_description;

            $imageName = $collectionSet->image_path;

            if ($request->hasFile('collection_image')) {

                if ($collectionSet->image_path && file_exists(public_path($collectionSet->image_path))) {
                    unlink(public_path($collectionSet->image_path));
                }

                try {
                    $image = $request->file('collection_image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('ego-assets/images/product_collections'), $imageName);
                    $imageName = 'ego-assets/images/product_collections/' . $imageName;
                    $collectionSet->image_path = $imageName;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Failed to upload file');
                }
            }

            $collectionSet->save();

            $notify[] = ['success', 'Collection set updated successfully.'];
            return redirect()->route('collectionSet.view')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function destroy(string $id)
    {
        $collectionSet = CollectionSet::findOrFail($id);
        if ($collectionSet->image_path && file_exists(public_path($collectionSet->image_path))) {
            unlink(public_path($collectionSet->image_path));
        }
        $collectionSet->delete();

        $notify[] = ['success', 'Collection Set deleted.'];
        return redirect()->back()->withNotify($notify);
    }

    public function singleCollection(Request $request, $id)
    {
        // Fetch the CollectionSet with its relationships
        $collectionSet = CollectionSet::with(['category', 'tone', 'duration'])
            ->where('id', $id)
            ->firstOrFail();
    
        // Start querying products based on the collection's category
        $productsQuery = Product::where('category_id', $collectionSet->category_id);
    
        // Apply tone and duration filters if they exist in the CollectionSet
        if ($collectionSet->tone_id) {
            $productsQuery->where('tone_id', $collectionSet->tone_id);
        }
    
        if ($collectionSet->duration_id) {
            $productsQuery->where('duration_id', $collectionSet->duration_id);
        }
    
        // Retrieve query parameters from the request
        $colorQueries = $request->query('colors');
        $colorArray = $colorQueries ? explode(',', $colorQueries) : [];
    
        $baseQueries = $request->query('base');
        $baseArray = $baseQueries ? explode(',', $baseQueries) : [];
    
        $diameterQueries = $request->query('diameter');
        $diameterArray = $diameterQueries ? explode(',', $diameterQueries) : [];
    
        $toneQueries = $request->query('tones');
        $toneArray = $toneQueries ? explode(',', $toneQueries) : [];
    
        $replacementQueries = $request->query('replacement');
        $replacementArray = $replacementQueries ? explode(',', $replacementQueries) : [];
    
        $materialQueries = $request->query('material');
        $materialArray = $materialQueries ? explode(',', $materialQueries) : [];
    
        $lensQueries = $request->query('lens');
        $lensArray = $lensQueries ? explode(',', $lensQueries) : [];
    
        // Apply additional filters based on request parameters
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
    
        if (!empty($replacementArray)) {
            $productsQuery->whereIn('duration_id', $replacementArray);
        }
    
        if (!empty($materialArray)) {
            $productsQuery->whereIn('material_id', $materialArray);
        }
    
        if (!empty($lensArray)) {
            $productsQuery->whereIn('lens_design_id', $lensArray);
        }
    
        // Execute the filtered query and get the products
        $productsforCollection = $productsQuery->get();
    
        // Retrieve necessary filter options for the view
        $colors = Color::all();
        $baseCurves = BaseCurve::all();
        $diameters = Diameter::all();
        $tones = Tone::all();
        $replacements = Duration::all();
        $materials = Material::all();
        $lenses = LensDesign::all();
    
        // Set the page title based on the category
        $pageTitle = $collectionSet->category->name;
    
        // Pass data to the view
        return view('ego.pages.single_collection', compact(
            'collectionSet', 
            'pageTitle', 
            'productsforCollection', 
            'colors', 
            'baseCurves', 
            'diameters', 
            'tones', 
            'replacements', 
            'materials', 
            'lenses',
            'colorArray',
            'baseArray',
            'diameterArray',
            'toneArray',
            'replacementArray',
            'materialArray',
            'lensArray',
        ));
    }
    
    
}
