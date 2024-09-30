<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Tone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ToneController extends Controller
{
    public function index()
    {
        $pageTitle = "Lens Tone";
        $tones = Tone::paginate(10);
        return view('ego.ego-admin.tone.index', compact('pageTitle', 'tones'));
    }

    public function create()
    {
        $pageTitle = "Create Tone";
        return view('ego.ego-admin.tone.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tones',
        ]);

        try {
            $tone = new Tone;
            $tone->name = $request->name;
            $tone->save();

            $notify[] = ['success', 'Tone created successfully.'];
            return redirect()->route('tone.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit($id)
    {
        $pageTitle = "Tone Edit";
        $tone = Tone::findOrFail($id);
        return view('ego.ego-admin.tone.edit', compact('pageTitle', 'tone'));
    }

    public function update(Request $request, $id)
    {
        $tone = Tone::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('diameters')->ignore($id),
            ],
        ]);
        $tone->name = $request->input('name');
        $tone->save();

        $notify[] = ['success', 'Tone updated successfully.'];
        return redirect()->route('tone.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $tone = Tone::findOrFail($id);
        $tone->delete();
        $notify[] = ['success', 'Tone deleted.'];
        return redirect()->back()->withNotify($notify);
    }
}
