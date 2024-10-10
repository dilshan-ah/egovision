<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Shipping Methods";
        $shippingMethods = ShippingMethod::all();
        return view('admin.shipping.index',compact('pageTitle','shippingMethods'));
    }

    public function create()
    {
        $pageTitle = "Create Shipping Methods";
        return view('admin.shipping.create',compact('pageTitle'));
    }

    public function store(Request $request)
    {
        try {
            $shippingMethod = new ShippingMethod();

            $shippingMethod->title = $request->title;
            $shippingMethod->place = $request->place;
            $shippingMethod->fee = $request->fee;

            $notify[] = ['success', 'Shipping Method created successfully.'];
            $shippingMethod->save();

            return redirect()->route('shipping.index')->withNotify($notify)->withInput();
        } catch (\Throwable $th) {
            $notify[] = ['error', 'Failed to create shipping method.'];
            return redirect()->back()->withNotify($notify)->withInput();
        }
    }

    public function edit(string $id)
    {
        $pageTitle = "Edit Shipping Methods";

        $shippingMethod = ShippingMethod::where('id',$id)->first();

        return view('admin.shipping.edit',compact('shippingMethod','pageTitle'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $shippingMethod = ShippingMethod::where('id',$id)->first();

            $shippingMethod->title = $request->title;
            $shippingMethod->place = $request->place;
            $shippingMethod->fee = $request->fee;

            $notify[] = ['success', 'Shipping Method updated successfully.'];
            $shippingMethod->save();

            return redirect()->route('shipping.index')->withNotify($notify)->withInput();
        } catch (\Throwable $th) {
            $notify[] = ['error', 'Failed to update shipping method.'];
            return redirect()->back()->withNotify($notify)->withInput();
        }
    }

    public function delete(string $id)
    {
        try {
            $shippingMethod = ShippingMethod::where('id',$id)->first();

            $notify[] = ['success', 'Shipping Method deleted successfully.'];
            $shippingMethod->delete();

            return redirect()->route('shipping.index')->withNotify($notify)->withInput();
        } catch (\Throwable $th) {
            $notify[] = ['error', 'Failed to delete shipping method.'];
            return redirect()->back()->withNotify($notify)->withInput();
        }
    }
}
