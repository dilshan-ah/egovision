<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EgoModels\WaterContent;
use Illuminate\Validation\Rule;

class WaterContentController extends Controller
{
    public function index()
    {
        $pageTitle = "Water Content";
        $water_contents = WaterContent::paginate(10);
        return view('ego.ego-admin.waterContent.index', compact('pageTitle', 'water_contents'));
    }

    public function create()
    {
        $pageTitle = "Create Water Content";
        return view('ego.ego-admin.waterContent.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:water_contents',
        ], [
            'name.required' => 'The water content field is required.',
            'name.unique' => 'The water content has already been taken.',
        ]);

        try {
            $water_content = new WaterContent;
            $water_content->name = $request->name;
            $water_content->save();

            $notify[] = ['success', 'Water content created successfully.'];
            return redirect()->route('water_content.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit($id)
    {
        $pageTitle = "Water Content Edit";
        $water_content = WaterContent::findOrFail($id);
        return view('ego.ego-admin.waterContent.edit', compact('pageTitle', 'water_content'));
    }

    public function update(Request $request, $id)
    {
        $water_content = WaterContent::findOrFail($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('water_contents')->ignore($id),
            ],
        ], [
            'name.required' => 'The water content field is required.'
        ]);
        $water_content->name = $request->input('name');
        $water_content->save();

        $notify[] = ['success', 'Water content updated successfully.'];
        return redirect()->route('water_content.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $water_content = WaterContent::findOrFail($id);
        $water_content->delete();
        $notify[] = ['success', 'Water content deleted.'];
        return redirect()->back()->withNotify($notify);
    }
}
