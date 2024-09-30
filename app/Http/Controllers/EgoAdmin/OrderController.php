<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Product;
use Illuminate\Http\Request;
use App\Models\EgoModels\Cart;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index($id)
    {
        $product = Product::with(['images','color','lensDesign','baseCurve','category','replacement','tone','material','variations'])
        ->findOrFail($id);
        $pageTitle = $product->name. ' | Ego Vision';
        return view('ego.pages.addToCart', compact('pageTitle', 'product'));
    }

    public function checkout()
    {
        $pageTitle = 'Checkout';
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        $response = Http::withOptions([
            'verify' => realpath('C:\\xampp\\php\\extras\\ssl\\cacert.pem')
        ])->get('https://countriesnow.space/api/v0.1/countries/states');       

        $data = $response->json();
        $countries = $data['data'];

        $dial = Http::withOptions([
            'verify' => realpath('C:\\xampp\\php\\extras\\ssl\\cacert.pem')
        ])->get('https://gist.githubusercontent.com/devhammed/78cfbee0c36dfdaa4fce7e79c0d39208/raw/494967e8ae71c9fed70650b35dd96e9273fa3344/countries.json');
        $dialdatas = $dial->json();
        return view('ego.pages.checkout',compact('carts','pageTitle','countries','dialdatas'));
    }
}
