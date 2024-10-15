<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodsController extends Controller
{
    public function allMethods()
    {
        $methods = ShippingMethod::select('id','title','place','fee')->get();

        return response()->json($methods);
    }
}
