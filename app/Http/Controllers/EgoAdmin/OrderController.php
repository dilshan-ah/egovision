<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Models\EgoModels\Product;
use Illuminate\Http\Request;
use App\Models\EgoModels\Cart;
use App\Models\EgoModels\Order;
use App\Models\GeneralSetting;
use App\Models\OrderStatusNote;
use App\Models\PromoCode;
use App\Models\ShippingMethod;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index($id)
    {
        $product = Product::with(['images', 'color', 'lensDesign', 'baseCurve', 'category', 'duration', 'tone', 'material', 'variations'])
            ->findOrFail($id);

        $preferredLanguage = session('preferredLanguage');

        $pageTitle = TranslationHelper::translateText($product->name . ' | Ego Vision', $preferredLanguage);

        $availablePowers = json_decode($product->available_powers) ?? [];
        $powers = $this->generatePowerValues($availablePowers);

        $product->name =  TranslationHelper::translateText($product->name, $preferredLanguage);
        $product->description =  TranslationHelper::translateText($product->description, $preferredLanguage);
        $product->product_intro =  TranslationHelper::translateText($product->product_intro, $preferredLanguage);
        if ($product->color) {
            @$product->color->name =  TranslationHelper::translateText(@$product->color->name ?? '', @$preferredLanguage);
        }
        if ($product->diameter) {
            $product->diameter->name =  TranslationHelper::translateText($product->diameter->name, $preferredLanguage);
        }
        if ($product->lensDesign) {
            $product->lensDesign->name =  TranslationHelper::translateText($product->lensDesign->name, $preferredLanguage);
        }
        if ($product->baseCurve) {
            $product->baseCurve->name =  TranslationHelper::translateText($product->baseCurve->name, $preferredLanguage);
        }
        if ($product->category) {
            $product->category->name =  TranslationHelper::translateText($product->category->name, $preferredLanguage);
        }
        if ($product->duration) {
            $product->duration->name =  TranslationHelper::translateText($product->duration->name, $preferredLanguage);
        }
        if ($product->tone) {
            $product->tone->name =  TranslationHelper::translateText($product->tone->name, $preferredLanguage);
        }
        if ($product->material) {
            $product->material->name =  TranslationHelper::translateText($product->material->name, $preferredLanguage);
        }
        $product->lens_params =  TranslationHelper::translateText((string) $product->lens_params, $preferredLanguage);

        $relatedProducts = collect();
        if($product->color){
            $relatedProducts = Product::with('color')
            ->whereHas('color', function ($query) use ($product) {
                $query->where('id', $product->color->id);
            })->where('id','!=',$product->id)
            ->get()->take(6);
        }
        
        
        foreach($relatedProducts as $relatedProduct){
            $relatedProduct->name = TranslationHelper::translateText((string) $relatedProduct->name, $preferredLanguage);
        }    


        return view('ego.pages.addToCart', compact('pageTitle', 'product', 'powers','relatedProducts'));
    }

    public function generatePowerValues($availablePowers)
    {
        $values = [];

        foreach ($availablePowers as $range) {
            // Extract the numbers from the range string
            preg_match_all('/-?\d+\.?\d*/', $range, $matches);

            if (count($matches[0]) == 2) {
                $start = floatval($matches[0][0]);
                $end = floatval($matches[0][1]);

                // dd($end);

                // Determine the interval based on the range
                if ($range === '(-0.25-6.00)' || $range === '(+0.25+6.00)') {
                    $interval = 0.25;
                } elseif ($range === '(-6.50-10.00)' || $range === '(+6.50+10.00)') {
                    $interval = 0.50;
                } else {
                    continue;
                }

                if ($start > 0) {
                    for ($value = $start; $value <= $end; $value += $interval) {
                        $values[] = round($value, 2);
                    }
                } else {
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

        $freeGift = Product::where('is_default_bag', '1')->first();

        $response = Http::withOptions([
            'verify' => realpath('C:\\xampp\\php\\extras\\ssl\\cacert.pem')
        ])->get('https://countriesnow.space/api/v0.1/countries/states');

        $data = $response->json();
        $countries = $data['data'];

        $dial = Http::withOptions([
            'verify' => realpath('C:\\xampp\\php\\extras\\ssl\\cacert.pem')
        ])->get('https://gist.githubusercontent.com/devhammed/78cfbee0c36dfdaa4fce7e79c0d39208/raw/494967e8ae71c9fed70650b35dd96e9273fa3344/countries.json');
        $dialdatas = $dial->json();

        $promoCodes = PromoCode::where('status', 'active')->get();

        $shippingMethods = ShippingMethod::all();

        $userDetail = Auth::user();

        $taxPerc = GeneralSetting::first()->tax;
        $userId = Auth::check() ? Auth::id() : null;
        $cartTotal = Cart::where(function ($query) use ($userId) {
            if ($userId) {
                $query->where('user_id', $userId);
            }
        })
            ->with('product')
            ->get()
            ->sum(function ($cart) {
                $price = $cart->power_status === 'no_power' ? $cart->product->no_power_price : $cart->product->price;
                return $cart->pair * $price;
            });

        $taxprice = $cartTotal * $taxPerc / 100;

        $total = $cartTotal + $taxprice;

        return view('ego.pages.checkout', compact('carts', 'pageTitle', 'countries', 'dialdatas', 'hasAccessory', 'freeGift', 'promoCodes', 'shippingMethods', 'userDetail', 'taxPerc', 'taxprice', 'total'));
    }


    public function indexadmin()
    {
        $pageTitle = 'Manage Order';
        $orders = Order::with('orderItems.product')->orderBy('created_at', 'desc')->searchable(['transaction_id', 'amount', 'status', 'orderItems.product:name'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('ego.ego-admin.order.index', compact('orders', 'pageTitle'));
    }

    public function updateStatus(string $id, Request $request)
    {
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($request->status == 'Pending') {
            $order->processing_time = null;
            $order->shipping_time = null;
            $order->completing_time = null;
            $order->failing_time = null;
            $order->cancelling_time = null;
            $order->returning_time = null;

            $orderNotes = OrderStatusNote::where('order_id', $id)->get();
            foreach ($orderNotes as $orderNote) {
                $orderNote->delete();
            }
        }

        if ($request->status == 'Processing') {
            $order->processing_time = Carbon::now();
            $order->shipping_time = null;
            $order->completing_time = null;
            $order->failing_time = null;
            $order->cancelling_time = null;
            $order->returning_time = null;

            $processingNote = OrderStatusNote::where('order_id', $id)->where('status', 'Processing')->first();

            if ($processingNote) {
                $processingNote->note =  $request->note;
                $processingNote->save();
            } elseif ($request->note) {
                $orderNote = new OrderStatusNote();
                $orderNote->order_id = $id;
                $orderNote->status = 'Processing';
                $orderNote->note = $request->note;
                $orderNote->save();

                $removeOthers =  OrderStatusNote::where('order_id', $id)->where('status', '!=', 'Processing')->get();

                foreach ($removeOthers as $removeOther) {
                    $removeOther->delete();
                }
            }
        }
        if ($request->status == 'Shipped') {
            $order->shipping_time = Carbon::now();
            $order->completing_time = null;
            $order->failing_time = null;
            $order->cancelling_time = null;
            $order->returning_time = null;

            $shippingNote = OrderStatusNote::where('order_id', $id)->where('status', 'Shipped')->first();

            if ($shippingNote) {
                $shippingNote->note =  $request->note;
                $shippingNote->save();
            } elseif ($request->note) {
                $orderNote = new OrderStatusNote();
                $orderNote->order_id = $id;
                $orderNote->status = 'Shipped';
                $orderNote->note = $request->note;
                $orderNote->save();

                $removeOthers =  OrderStatusNote::where('order_id', $id)->where('status', '!=', 'Processing')->where('status', '!=', 'Shipped')->get();

                foreach ($removeOthers as $removeOther) {
                    $removeOther->delete();
                }
            }
        }
        if ($request->status == 'Complete') {
            $order->completing_time = Carbon::now();
            $order->failing_time = null;
            $order->cancelling_time = null;
            $order->returning_time = null;

            $completingNote = OrderStatusNote::where('order_id', $id)->where('status', 'Complete')->first();

            if ($completingNote) {
                $completingNote->note =  $request->note;
                $completingNote->save();
            } elseif ($request->note) {
                $orderNote = new OrderStatusNote();
                $orderNote->order_id = $id;
                $orderNote->status = 'Complete';
                $orderNote->note = $request->note;
                $orderNote->save();


                $removeOthers =  OrderStatusNote::where('order_id', $id)->where('status', '!=', 'Processing')->where('status', '!=', 'Shipped')->where('status', '!=', 'Complete')->get();

                foreach ($removeOthers as $removeOther) {
                    $removeOther->delete();
                }
            }
        }
        if ($request->status == 'Failed') {
            $order->failing_time = Carbon::now();
            $order->cancelling_time = null;
            $order->returning_time = null;

            $failingNote = OrderStatusNote::where('order_id', $id)->where('status', 'Failed')->first();

            if ($failingNote) {
                $failingNote->note =  $request->note;
                $failingNote->save();
            } elseif ($request->note) {
                $orderNote = new OrderStatusNote();
                $orderNote->order_id = $id;
                $orderNote->status = 'Failed';
                $orderNote->note = $request->note;
                $orderNote->save();
            }
        }
        if ($request->status == 'Canceled') {
            $order->cancelling_time = Carbon::now();
            $order->returning_time = null;

            $cancellingNote = OrderStatusNote::where('order_id', $id)->where('status', 'Cancelled')->first();

            if ($cancellingNote) {
                $cancellingNote->note =  $request->note;
                $cancellingNote->save();
            } elseif ($request->note) {
                $orderNote = new OrderStatusNote();
                $orderNote->order_id = $id;
                $orderNote->status = 'Cancelled';
                $orderNote->note = $request->note;
                $orderNote->save();
            }
        }
        if ($request->status == 'Returned') {
            $order->returning_time = Carbon::now();

            $returningNote = OrderStatusNote::where('order_id', $id)->where('status', 'Returned')->first();

            if ($returningNote) {
                $returningNote->note =  $request->note;
                $returningNote->save();
            } elseif ($request->note) {
                $orderNote = new OrderStatusNote();
                $orderNote->order_id = $id;
                $orderNote->status = 'Returned';
                $orderNote->note = $request->note;
                $orderNote->save();
            }
        }

        $order->status = $request->status;
        $order->save();
        $notify[] = ['success', 'Order Status Updated'];
        return redirect()->back()->withNotify($notify);
    }


    public function viewOrder(string $id)
    {
        $order = Order::where('id', $id)->first();
        $processingNote = OrderStatusNote::where('order_id', $id)->where('status', 'Processing')->first();
        $shippingNote = OrderStatusNote::where('order_id', $id)->where('status', 'Shipped')->first();
        $completingNote = OrderStatusNote::where('order_id', $id)->where('status', 'Complete')->first();
        $failingNote = OrderStatusNote::where('order_id', $id)->where('status', 'Failed')->first();
        $cancellingNote = OrderStatusNote::where('order_id', $id)->where('status', 'Cancelled')->first();
        $returningNote = OrderStatusNote::where('order_id', $id)->where('status', 'Returned')->first();
        $pageTitle = "Order Details";
        return view('ego.ego-admin.order.view', compact('order', 'pageTitle', 'processingNote', 'shippingNote', 'completingNote', 'failingNote', 'cancellingNote', 'returningNote'));
    }

    public function updateBilling(string $id, Request $request)
    {
        try {
            $order = Order::where('id', $id)->first();

            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->company = $request->company;
            $order->address_one = $request->address_one;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->country = $request->country;
            $order->zip_code = $request->zip_code;

            $order->save();
            $notify[] = ['success', 'Address Updated successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (\Throwable $th) {
            $notify[] = ['error', $th];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function invoice(string $id)
    {
        $order = Order::where('id', $id)->with('orderItems')->first();
        $url = route('ego.single.orders', $id);
        $qrCode = QrCode::size(80)->generate($url);
        return view('user.order.invoice', compact('order', 'qrCode'));
    }

    public function updatePayment(string $id, Request $request)
    {
        try {
            $order = Order::where('id', $id)->first();

            $order->payment_status = $request->payment_status;

            $order->save();
            $notify[] = ['success', 'Payment status successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (\Throwable $th) {
            $notify[] = ['error', $th];
            return redirect()->back()->withNotify($notify);
        }
    }
}
