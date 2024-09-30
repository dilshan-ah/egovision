<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\LensPower;
use Illuminate\Http\Request;

class LensPowerController extends Controller
{
    public function index()
    {
        $pageTitle = "Lens Powers";
        $lensPowers = LensPower::orderBy('created_at','desc')->get();
        return view('ego.ego-admin.lensPower.index', compact('pageTitle', 'lensPowers'));
    }

    public function create()
    {
        $pageTitle = "Create Lens Powers";
        return view('ego.ego-admin.lensPower.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:lens_powers',
        ], [
            'name.required' => 'The lens power field is required.'
        ]);

        try {
            $lensPower = new LensPower;
            $lensPower->name = $request->name;
            $lensPower->save();

            $notify[] = ['success', 'Lens Powers created successfully.'];
            return redirect()->route('lensPower.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit($id)
    {
        $pageTitle = "Lens Powers Edit";
        $bases = LensPower::findOrFail($id);
        return view('ego.ego-admin.lensPower.edit', compact('pageTitle', 'bases'));
    }

    public function update(Request $request, $id)
    {
        $bases = LensPower::findOrFail($id);
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

        $notify[] = ['success', 'Lens Powers updated successfully.'];
        return redirect()->route('lensPower.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $bases = LensPower::findOrFail($id);
        $bases->delete();
        $notify[] = ['success', 'Lens Powers deleted.'];
        return redirect()->back()->withNotify($notify);
    }
}
