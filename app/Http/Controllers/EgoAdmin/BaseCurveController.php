<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EgoModels\BaseCurve;
use Illuminate\Validation\Rule;

class BaseCurveController extends Controller
{
    public function index()
    {
        $pageTitle = "Lens Base Curve";
        $bases = BaseCurve::paginate(10);
        return view('ego.ego-admin.baseCurves.index', compact('pageTitle', 'bases'));
    }

    public function create()
    {
        $pageTitle = "Create Base Curve";
        return view('ego.ego-admin.baseCurves.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:base_curves',
        ], [
            'name.required' => 'The base curve field is required.'
        ]);

        try {
            $baseCurve = new BaseCurve;
            $baseCurve->name = $request->name;
            $baseCurve->save();

            $notify[] = ['success', 'BaseCurve created successfully.'];
            return redirect()->route('baseCurve.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit($id)
    {
        $pageTitle = "Base Curve Edit";
        $bases = BaseCurve::findOrFail($id);
        return view('ego.ego-admin.baseCurves.edit', compact('pageTitle', 'bases'));
    }

    public function update(Request $request, $id)
    {
        $bases = BaseCurve::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('base_curves')->ignore($id),
            ],
        ], [
            'name.required' => 'The base curve field is required.'
        ]);
        $bases->name = $request->input('name');
        $bases->save();

        $notify[] = ['success', 'Base Curve updated successfully.'];
        return redirect()->route('baseCurve.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $bases = BaseCurve::findOrFail($id);
        $bases->delete();
        $notify[] = ['success', 'Base Curve deleted.'];
        return redirect()->back()->withNotify($notify);
    }
}
