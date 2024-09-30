<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EgoModels\LensDesign;
use Illuminate\Validation\Rule;

class LenseDesignController extends Controller
{
    public function index()
    {
        $pageTitle = "lens Design";
        $bases = LensDesign::paginate(10);
        return view('ego.ego-admin.lenseDesign.index', compact('pageTitle', 'bases'));
    }

    public function create()
    {
        $pageTitle = "Create lens Design";
        return view('ego.ego-admin.lenseDesign.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:lens_designs',
        ], [
            'name.required' => 'The lenseDesign field is required.'
        ]);

        try {
            $baseCurve = new LensDesign;
            $baseCurve->name = $request->name;
            $baseCurve->save();

            $notify[] = ['success', 'lense Design created successfully.'];
            return redirect()->route('lensDesign.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit($id)
    {
        $pageTitle = "lens Design Edit";
        $bases = LensDesign::findOrFail($id);
        return view('ego.ego-admin.lenseDesign.edit', compact('pageTitle', 'bases'));
    }

    public function update(Request $request, $id)
    {
        $bases = LensDesign::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('product_categories')->ignore($id),
            ],
        ], [
            'name.required' => 'The lens design field is required.'
        ]);
        $bases->name = $request->input('name');
        $bases->save();

        $notify[] = ['success', 'Lens Design updated successfully.'];
        return redirect()->route('lenseDesign.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $bases = LensDesign::findOrFail($id);
        $bases->delete();
        $notify[] = ['success', 'Lens Design deleted.'];
        return redirect()->back()->withNotify($notify);
    }
}
