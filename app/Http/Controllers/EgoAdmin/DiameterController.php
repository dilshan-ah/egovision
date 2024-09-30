<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Diameter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiameterController extends Controller
{
    public function index()
    {
        $pageTitle = "Lens Diameter";
        $diameters = Diameter::paginate(10);
        return view('ego.ego-admin.diameter.index', compact('pageTitle', 'diameters'));
    }

    public function create()
    {
        $pageTitle = "Create Diameter";
        return view('ego.ego-admin.diameter.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:diameters',
        ]);

        try {
            $diameter = new Diameter;
            $diameter->name = $request->name;
            $diameter->save();

            $notify[] = ['success', 'Diameter created successfully.'];
            return redirect()->route('diameter.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit($id)
    {
        $pageTitle = "Diameter Edit";
        $diameter = Diameter::findOrFail($id);
        return view('ego.ego-admin.diameter.edit', compact('pageTitle', 'diameter'));
    }

    public function update(Request $request, $id)
    {
        $diameter = Diameter::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('diameters')->ignore($id),
            ],
        ]);
        $diameter->name = $request->input('name');
        $diameter->save();

        $notify[] = ['success', 'Diameter updated successfully.'];
        return redirect()->route('diameter.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $diameter = Diameter::findOrFail($id);
        $diameter->delete();
        $notify[] = ['success', 'Diameter deleted.'];
        return redirect()->back()->withNotify($notify);
    }
}
