<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Banner;
use App\Models\EgoModels\Product;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $pageTitle = 'Ego Vision | Banners';
        $banners = Banner::with('product')->get();
        return view('ego.ego-admin.banner.index', compact('pageTitle', 'banners'));
    }

    public function create()
    {
        $pageTitle = 'Ego Vision | Create Banner';

        $products = Product::all();

        return view('ego.ego-admin.banner.create', compact('pageTitle', 'products'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            'product_id' => 'required',
        ], [
            'banner_image.required' => 'Banner is required',
            'banner_image.image' => 'The file must be an image',
            'banner_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif',
            'banner_image.max' => 'The image must not be larger than 2MB',
            'product_id.required' => 'Select a product to link with the banner'
        ]);

        try {
            $banner = new Banner();
            $banner->product_id = $request->product_id;
            $banner->title = $request->banner_title;
            $banner->btn_text = $request->btn_text;

            if ($request->hasFile('banner_image')) {
                try {
                    $image = $request->file('banner_image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('ego-assets/images/banners'), $imageName);
                    $imageName = 'ego-assets/images/banners/' . $imageName;
                    $banner->banner_path = $imageName;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Failed to upload file');
                }
            }

            $banner->save();

            $notify[] = ['success', 'Banner created successfully.'];
            return redirect()->route('banner.view')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        $pageTitle = 'Ego Vision | Edit ' . $banner->name;
        $products = Product::all();
        return view('ego.ego-admin.banner.edit', compact('banner', 'pageTitle', 'products'));
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'banner_image.image' => 'The file must be an image',
            'banner_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif',
            'banner_image.max' => 'The image must not be larger than 2MB'
        ]);
        
        try {
            $banner = Banner::findOrFail($id);

            $banner->product_id = $request->product_id;
            $banner->title = $request->banner_title;
            $banner->btn_text = $request->btn_text;

            if ($request->hasFile('banner_image')) {

                if ($banner->banner_path && file_exists(public_path($banner->banner_path))) {
                    unlink(public_path($banner->banner_path));
                }

                try {
                    $image = $request->file('banner_image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('ego-assets/images/banners'), $imageName);
                    $imageName = 'ego-assets/images/banners/' . $imageName;
                    $banner->banner_path = $imageName;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Failed to upload file');
                }
            }

            $banner->save();

            $notify[] = ['success', 'Banner updated successfully.'];
            return redirect()->route('banner.view')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function destroy(string $id)
    {
        try {
            $banner = Banner::findOrFail($id);

            if ($banner->banner_path && file_exists(public_path($banner->banner_path))) {
                unlink(public_path($banner->banner_path));
            }

            $banner->delete();

            $notify[] = ['success', 'Banner deleted successfully.'];
            return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function fetchBanner()
    {
        $banners = Banner::all();
        return view('ego.include.banner', compact('banners'));
    }
}
