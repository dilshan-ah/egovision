<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\Product;
use Illuminate\Http\Request;
use App\Models\EgoModels\Cart;
use App\Models\EgoModels\Order;
use App\Models\PromoCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index($id)
    {
        $product = Product::with(['images', 'color', 'lensDesign', 'baseCurve', 'category', 'duration', 'tone', 'material', 'variations'])
            ->findOrFail($id);
        $pageTitle = $product->name . ' | Ego Vision';
    
        $availablePowers = json_decode($product->available_powers) ?? [];
        $powers = $this->generatePowerValues($availablePowers); // Use $this to call the method
        
        return view('ego.pages.addToCart', compact('pageTitle', 'product','powers'));
    }

    public function generatePowerValues($availablePowers) {
        $values = [];
    
        foreach ($availablePowers as $range) {
            // Extract the numbers from the range string
            preg_match_all('/-?\d+\.?\d*/', $range, $matches);
    
            if (count($matches[0]) == 2) {
                $start = floatval($matches[0][0]);
                $end = floatval($matches[0][1]);

                // dd($end);
    
                // Determine the interval based on the range
                if ($range === '(-0.25-6.00)' || $range === '(+0.25+6.00)' ) {
                    $interval = 0.25;
                } elseif ($range === '(-6.50-10.00)' || $range === '(+6.50+10.00)') {
                    $interval = 0.50;
                } else {
                    continue;
                }
    
                if($start > 0)
                {
                    for ($value = $start; $value <= $end; $value += $interval) {
                        $values[] = round($value, 2);
                    }
                }else{
                    for ($value = $start; $value >= $end; $value -= $interval) {
                        $values[] = round($value, 2);
                    }
                }

            }
        }
    
        return $values;
    }

    public function checkout()
    {
        $pageTitle = 'Checkout';
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        $hasAccessory = $carts->contains(function ($cartItem) {
            return $cartItem->product->product_type == 'accessories';
        });

        $freeGift = Product::where('is_default_bag','1')->first();

        $response = Http::withOptions([
            'verify' => realpath('C:\\xampp\\php\\extras\\ssl\\cacert.pem')
        ])->get('https://countriesnow.space/api/v0.1/countries/states');       

        $data = $response->json();
        $countries = $data['data'];

        $dial = Http::withOptions([
            'verify' => realpath('C:\\xampp\\php\\extras\\ssl\\cacert.pem')
        ])->get('https://gist.githubusercontent.com/devhammed/78cfbee0c36dfdaa4fce7e79c0d39208/raw/494967e8ae71c9fed70650b35dd96e9273fa3344/countries.json');
        $dialdatas = $dial->json();

        $promoCodes = PromoCode::where('status','active')->get();

        return view('ego.pages.checkout',compact('carts','pageTitle','countries','dialdatas','hasAccessory','freeGift','promoCodes'));
    }


    public function indexadmin()
    {
        $pageTitle = 'Manage Order';
        $orders = Order::with('orderItems.product')->orderBy('created_at','desc')->get();
        return view('ego.ego-admin.order.index',compact('orders','pageTitle'));
    }

    public function updateStatus(string $id, Request $request)
    {
        $order = Order::where('id', $id)->first();
        
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if($request->status == 'Pending')
        {
            $order->processing_time = null;
            $order->shipping_time = null;
            $order->completing_time = null;
            $order->failing_time = null;
            $order->cancelling_time = null;
            $order->returning_time = null;
        }

        if($request->status == 'Processing')
        {
            $order->processing_time = Carbon::now();
            $order->shipping_time = null;
            $order->completing_time = null;
            $order->failing_time = null;
            $order->cancelling_time = null;
            $order->returning_time = null;
        }
        if($request->status == 'Shipped')
        {
            $order->shipping_time = Carbon::now();
            $order->completing_time = null;
            $order->failing_time = null;
            $order->cancelling_time = null;
            $order->returning_time = null;
        }
        if($request->status == 'Complete')
        {
            $order->completing_time = Carbon::now();
            $order->failing_time = null;
            $order->cancelling_time = null;
            $order->returning_time = null;
        }
        if($request->status == 'Failed')
        {
            $order->failing_time = Carbon::now();
            $order->cancelling_time = null;
            $order->returning_time = null;
        }
        if($request->status == 'Canceled')
        {
            $order->cancelling_time = Carbon::now();
            $order->returning_time = null;
        }
        if($request->status == 'Returned')
        {
            $order->returning_time = Carbon::now();
        }
    
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order status updated successfully']);
    }


    public function viewOrder(string $id)
    {
        $order = Order::where('id',$id)->first();
        $pageTitle = "Order Details";
        return view('ego.ego-admin.order.view',compact('order','pageTitle'));
    }
    
}
