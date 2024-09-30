<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Replacement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReplacementController extends Controller
{
    public function index()
    {
        $pageTitle = "Lens Replacement";
        $replacements = Replacement::paginate(10);
        return view('ego.ego-admin.replacement.index', compact('pageTitle', 'replacements'));
    }

    public function create()
    {
        $pageTitle = "Create Replacement";
        return view('ego.ego-admin.replacement.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:replacements',
        ]);

        try {
            $replacement = new Replacement;
            $replacement->name = $request->name;
            $replacement->save();

            $notify[] = ['success', 'Replacement created successfully.'];
            return redirect()->route('replacement.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit($id)
    {
        $pageTitle = "Replacement Edit";
        $replacement = Replacement::findOrFail($id);
        return view('ego.ego-admin.replacement.edit', compact('pageTitle', 'replacement'));
    }

    public function update(Request $request, $id)
    {
        $replacement = Replacement::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('diameters')->ignore($id),
            ],
        ]);
        $replacement->name = $request->input('name');
        $replacement->save();

        $notify[] = ['success', 'Replacement updated successfully.'];
        return redirect()->route('replacement.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $replacement = Replacement::findOrFail($id);
        $replacement->delete();
        $notify[] = ['success', 'Replacement deleted.'];
        return redirect()->back()->withNotify($notify);
    }
}
