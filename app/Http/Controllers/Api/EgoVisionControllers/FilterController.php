<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\Duration;
use App\Models\EgoModels\BaseCurve;
use App\Models\EgoModels\Color;
use App\Models\EgoModels\Diameter;
use App\Models\EgoModels\LensDesign;
use App\Models\EgoModels\Material;
use App\Models\EgoModels\Tone;
use Illuminate\Http\Request;

class FilterController extends Controller
{

    public function filter()
    {
        try {
            // Fetch all filters
            $colors = Color::select('id', 'name', 'color_code')->get();
            $baseCurves = BaseCurve::select('id', 'name')->get();
            $diameters = Diameter::select('id', 'name')->get();
            $tones = Tone::select('id', 'name')->get();
            $replacements = Duration::select('id', 'name')->get();
            $materials = Material::select('id', 'name')->get();
            $lensDesigns = LensDesign::select('id', 'name')->get();
    
            // Format the results
            $formattedColors = $colors->map(function ($color) {
                return [
                    'id' => $color->id,
                    'name' => $color->name,
                    'color_code' => '0xff' . ltrim($color->color_code, '#'),
                ];
            });
    
            $formattedBaseCurves = $baseCurves->map(function ($baseCurve) {
                return [
                    'id' => $baseCurve->id,
                    'name' => $baseCurve->name,
                ];
            });
    
            $formattedDiameters = $diameters->map(function ($diameter) {
                return [
                    'id' => $diameter->id,
                    'name' => $diameter->name,
                ];
            });
    
            $formattedTones = $tones->map(function ($tone) {
                return [
                    'id' => $tone->id,
                    'name' => $tone->name,
                ];
            });
    
            $formattedReplacements = $replacements->map(function ($replacement) {
                return [
                    'id' => $replacement->id,
                    'name' => $replacement->name,
                ];
            });
    
            $formattedMaterials = $materials->map(function ($material) {
                return [
                    'id' => $material->id,
                    'name' => $material->name,
                ];
            });
    
            $formattedLensDesigns = $lensDesigns->map(function ($lensDesign) {
                return [
                    'id' => $lensDesign->id,
                    'name' => $lensDesign->name,
                ];
            });
    
            // Return response with all the formatted data
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'Filters fetched successfully',
                'data' => [
                    'colors' => $formattedColors,
                    'base_curves' => $formattedBaseCurves,
                    'diameters' => $formattedDiameters,
                    'tones' => $formattedTones,
                    'replacements' => $formattedReplacements,
                    'materials' => $formattedMaterials,
                    'lens_designs' => $formattedLensDesigns,
                ]
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
