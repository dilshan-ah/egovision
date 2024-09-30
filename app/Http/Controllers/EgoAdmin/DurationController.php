<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\Duration;
use App\Models\EgoModels\BaseCurve;
use App\Models\EgoModels\Color;
use App\Models\EgoModels\Diameter;
use App\Models\EgoModels\LensDesign;
use App\Models\EgoModels\Material;
use App\Models\EgoModels\Tone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DurationController extends Controller
{
    public function index()
    {
        $pageTitle = "Duration";
        $durations = Duration::paginate(10);
        return view('ego.ego-admin.duration.index', compact('pageTitle', 'durations'));
    }

    public function create()
    {
        // dd('asspjpoj' );
        $pageTitle = "Create Duration";
        return view('ego.ego-admin.duration.durationcreate', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:diameters',
            'duration_image' => 'required',
            'duration_description' => 'required',
        ]);

        try {
            $duration = new Duration();
            $duration->name = $request->name;
            $duration->months = $request->month;
            $duration->description = $request->duration_description;

            $imageName ='';

            if ($request->hasFile('duration_image')) {
                try {
                    $image = $request->file('duration_image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('ego-assets/images/product_durations'), $imageName);
                    $imageName = 'ego-assets/images/product_durations/' . $imageName;
                    $duration->image_path = $imageName;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Failed to upload file');
                }
            }
            
            $duration->save();

            $notify[] = ['success', 'Duration created successfully.'];
            return redirect()->route('duration.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }


    public function edit($id)
    {
        $pageTitle = "Duration Edit";
        $duration = Duration::findOrFail($id);
        return view('ego.ego-admin.duration.durationedit', compact('pageTitle', 'duration'));
    }

    public function update(Request $request, $id)
    {
        $duration = Duration::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('durations')->ignore($id),
            ],
        ]);
        $duration->name = $request->input('name');
        $duration->months = $request->month;
        $duration->description = $request->duration_description;

        $imageName = $duration->image_path;

        if ($request->hasFile('duration_image')) {

            if ($duration->image_path && file_exists(public_path($duration->image_path))) {
                unlink(public_path($duration->image_path));
            }

            try {
                $image = $request->file('duration_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('ego-assets/images/product_durations'), $imageName);
                $imageName = 'ego-assets/images/product_durations/' . $imageName;
                $duration->image_path = $imageName;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to upload file');
            }
        }

        $duration->save();

        $notify[] = ['success', 'Duration updated successfully.'];
        return redirect()->route('duration.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $duration = Duration::findOrFail($id);
        
        if ($duration->delete()) {

            if ($duration->image_path && file_exists(public_path($duration->thumbnail))) {
                unlink(public_path($duration->image_path));
            }
        }
        $notify[] = ['success', 'Duration deleted.'];
        return redirect()->back()->withNotify($notify);
    }


    public function singleDuration(Request $request, string $id)
    {
        $duration = Duration::findOrFail($id);
        $pageTitle = $duration->name;

        $productsQuery = $duration->products();

        $colorQueries = $request->query('colors');
        $colorArray = $colorQueries ? explode(',', $colorQueries) : [];

        $baseQueries = $request->query('base');
        $baseArray = $baseQueries ? explode(',', $baseQueries) : [];

        $diameterQueries = $request->query('diameter');
        $diameterArray = $diameterQueries ? explode(',', $diameterQueries) : [];

        $toneQueries = $request->query('tones');
        $toneArray = $toneQueries ? explode(',', $toneQueries) : [];

        $materialQueries = $request->query('material');
        $materialArray = $materialQueries ? explode(',', $materialQueries) : [];

        $lensQueries = $request->query('lens');
        $lensArray = $lensQueries ? explode(',', $lensQueries) : [];

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

        if (!empty($materialArray)) {
            $productsQuery->whereIn('material_id', $materialArray);
        }

        if (!empty($lensArray)) {
            $productsQuery->whereIn('lens_design_id', $lensArray);
        }

        $products = $productsQuery->get();

        $colors = Color::all();
        $baseCurves = BaseCurve::all();
        $diameters = Diameter::all();
        $tones = Tone::all();
        $replacements = Duration::all();
        $materials = Material::all();
        $lenses = LensDesign::all();

        return view('ego.pages.single_duration', compact('duration', 'pageTitle', 'products','colors',  'baseCurves', 'diameters', 'tones', 'materials', 'lenses','colorArray', 'baseArray','diameterArray','toneArray','materialArray','lensArray'));
    }

}
