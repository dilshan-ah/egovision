<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Material;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
{
    public function index()
    {
        $pageTitle = "Lens Material";
        $materials = Material::paginate(10);
        return view('ego.ego-admin.material.index', compact('pageTitle', 'materials'));
    }

    public function create()
    {
        $pageTitle = "Create Material";
        return view('ego.ego-admin.material.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:materials',
        ]);

        try {
            $material = new Material;
            $material->name = $request->name;
            $material->save();

            $notify[] = ['success', 'Material created successfully.'];
            return redirect()->route('material.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit($id)
    {
        $pageTitle = "Material Edit";
        $material = Material::findOrFail($id);
        return view('ego.ego-admin.material.edit', compact('pageTitle', 'material'));
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('materials')->ignore($id),
            ],
        ]);
        $material->name = $request->input('name');
        $material->save();

        $notify[] = ['success', 'Material updated successfully.'];
        return redirect()->route('material.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        $notify[] = ['success', 'Material deleted.'];
        return redirect()->back()->withNotify($notify);
    }
}
