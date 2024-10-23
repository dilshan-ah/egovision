<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Models\Duration;
use App\Models\EgoModels\BaseCurve;
use App\Models\EgoModels\Color;
use App\Models\EgoModels\Diameter;
use App\Models\EgoModels\LensDesign;
use App\Models\EgoModels\Material;
use App\Models\EgoModels\Product;
use App\Models\EgoModels\Tone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class ColorController extends Controller
{
    private function generateUniqueImageName($extension, $destinationPath)
    {
        do {
            $randomNumber = mt_rand(100000, 999999);
            $imageName = $randomNumber . '.' . $extension;
            $existingRecord = Color::where('image_path', $destinationPath . '/' . $imageName)->first();
        } while ($existingRecord || File::exists(public_path($destinationPath . '/' . $imageName)));
        return $imageName;
    }
    public function index()
    {
        $pageTitle = "Lens Colors";
        $colors = Color::paginate(10);
        return view('ego.ego-admin.colors.index', compact('pageTitle', 'colors'));
    }

    public function create()
    {
        $pageTitle = "Create Colors";
        return view('ego.ego-admin.colors.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:colors',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'color_intro' => 'required',
            'color_code' => 'required',
        ], [
            'name.required' => 'The color field is required.',
            'image.required' => 'The color image is required.',
            'color_intro.required' => 'The color intro is required.',
            'color_code.required' => 'The color code is required.'
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $imageName = $this->generateUniqueImageName($extension, 'ego-assets/images/color_image');
                $image->move(public_path('ego-assets/images/color_image'), $imageName);
                $imagePath = 'ego-assets/images/color_image/' . $imageName;
            }
            $color = new Color;
            $color->name = $request->name;
            $color->color_intro = $request->color_intro;
            $color->color_code = $request->color_code;
            $color->image_path = $imagePath;
            $color->save();

            $notify[] = ['success', 'Color created successfully.'];
            return redirect()->route('color.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit($id)
    {
        $pageTitle = "Color Edit";
        $color = Color::findOrFail($id);
        return view('ego.ego-admin.colors.edit', compact('pageTitle', 'color'));
    }

    public function update(Request $request, $id)
    {
        $color = Color::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('colors')->ignore($id),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'color_intro' => 'required'
        ], [
            'name.required' => 'The color field is required.'
        ]);
        $color->name = $request->input('name');
        if ($request->hasFile('image')) {
            if ($color->image_path && file_exists(public_path($color->image_path))) {
                unlink(public_path($color->image_path));
            }
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = $this->generateUniqueImageName($extension, 'ego-assets/images/color_image');
            $image->move(public_path('ego-assets/images/color_image'), $imageName);
            $color->image_path = 'ego-assets/images/color_image/' . $imageName;
        }
        $color->color_intro = $request->color_intro;
        $color->color_code = $request->color_code;
        $color->save();

        $notify[] = ['success', 'Color updated successfully.'];
        return redirect()->route('color.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $color = Color::findOrFail($id);

        if ($color->products()->exists()) {
            $notify[] = ['error', 'Cannot delete this color because it is associated with one or more products.'];
            return redirect()->back()->withNotify($notify);
        }

        if ($color->image_path && file_exists(public_path($color->image_path))) {
            unlink(public_path($color->image_path));
        }

        $color->delete();
        $notify[] = ['success', 'Color deleted.'];
        return redirect()->back()->withNotify($notify);
    }


    public function singleColor(Request $request, string $id)
    {
        $preferredLanguage = session('preferredLanguage');

        $color = Color::findOrFail($id);
        $color->name = TranslationHelper::translateText($color->name, $preferredLanguage);
        $pageTitle = TranslationHelper::translateText($color->name, $preferredLanguage);
    
        $productsQuery = $color->products();
    
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
    
        // Apply filters to the query
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
    
        $products = $productsQuery->get();

        foreach($products as $product)
        {
            $product->name = TranslationHelper::translateText($product->name, $preferredLanguage);
            $product->price = TranslationHelper::translateText((string) $product->price, $preferredLanguage);
        }
    
        // Retrieve other required data for the view
        $baseCurves = BaseCurve::all();
        foreach($baseCurves as $baseCurve)
        {
            $baseCurve->name = TranslationHelper::translateText($baseCurve->name, $preferredLanguage);
        }
        $diameters = Diameter::all();
        foreach($diameters as $diameter)
        {
            $diameter->name = TranslationHelper::translateText($diameter->name, $preferredLanguage);
        }
        $tones = Tone::all();
        foreach($tones as $tone)
        {
            $tone->name = TranslationHelper::translateText($tone->name, $preferredLanguage);
        }
        $replacements = Duration::all();
        foreach($replacements as $replacement)
        {
            $replacement->name = TranslationHelper::translateText($replacement->name, $preferredLanguage);
        }
        $materials = Material::all();
        foreach($materials as $material)
        {
            $material->name = TranslationHelper::translateText($material->name, $preferredLanguage);
        }
        $lenses = LensDesign::all();
        foreach($lenses as $lense)
        {
            $lense->name = TranslationHelper::translateText($lense->name, $preferredLanguage);
        }
    
        // Return the view with the required data
        return view('ego.pages.single_color', compact('color', 'pageTitle', 'products', 'baseCurves', 'diameters', 'tones', 'replacements', 'materials', 'lenses','baseArray','diameterArray','toneArray','replacementArray','materialArray','lensArray'));
    }
    
}
