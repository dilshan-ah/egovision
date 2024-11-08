<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Lib\SslCommerz\SslCommerzNotification;
use App\Models\EgoModels\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\EgoModels\OrderItems;
use App\Models\GeneralSetting;
use App\Models\PromoCode;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $request->session()->getId();

        $cartTotal = Cart::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
            ->with('product')
            ->get()
            ->sum(function ($cart) {
                $price = $cart->power_status === 'no_power' ? $cart->product->no_power_price : $cart->product->price;
                return $cart->pair * $price;
            });

        $carts = Cart::where('user_id', Auth::id())->get();


        $freeProductsTotal = $carts->filter(function ($cart) {
            return $cart->product->is_free == 1; // Filter products where is_free == 1
        })->sum(function ($cart) {
            return $cart->product->no_power_price * $cart->pair;
        });

        $promo = PromoCode::where('reedem_code', $request->promo_code)->where('status', 'active')->first();

        if ($promo) {
            $discount = ($promo->offer_amount / 100) * $cartTotal;
            $overallDiscount = $discount + $freeProductsTotal;
        } else {
            $overallDiscount = $freeProductsTotal;
        }

        $tax = GeneralSetting::first()->tax;

        $taxPrice = $cartTotal * $tax / 100;

        // Prepare data for payment
        $post_data = array();
        $post_data['delivery'] = $request->delivery;
        $post_data['total_amount'] = $post_data['delivery'] + $cartTotal - $overallDiscount + $taxPrice;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid();

        // CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->first_name . ' ' . $request->last_name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address_one;
        $post_data['cus_add2'] = $request->address_two;
        $post_data['cus_city'] = $request->city;
        $post_data['cus_state'] = $request->state;
        $post_data['cus_postcode'] = $request->zip;
        $post_data['cus_country'] = $request->country;
        $post_data['cus_company'] = $request->company;
        $post_data['cus_phone'] = $request->dial_code . $request->phone;
        $post_data['cus_fax'] = "";

        $post_data['payment_method'] = $request->payment_method;

        // SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        // OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";




        // Before initiating the payment, insert or update order status as Pending
        DB::table('orders')->updateOrInsert([
            'transaction_id' => $post_data['tran_id'],
        ], [
            'user_id' => Auth::user()->id,
            'name' => $post_data['cus_name'],
            'email' => $post_data['cus_email'],
            'phone' => $post_data['cus_phone'],
            'status' => 'Pending',
            'address_one' => $post_data['cus_add1'],
            'address_two' => $post_data['cus_add2'],
            'city' => $post_data['cus_city'],
            'company' => $post_data['cus_company'],
            'state' => $post_data['cus_state'],
            'country' => $post_data['cus_country'],
            'zip_code' => $post_data['cus_postcode'],
            'currency' => $post_data['currency'],
            'delivery_charge' => $post_data['delivery'],
            'subtotal' => $cartTotal,
            'payment_method' => $post_data['payment_method'],
            'discount' => $overallDiscount,
            'amount' => $post_data['delivery'] + $cartTotal - $overallDiscount + $taxPrice,
            'tax' => $taxPrice,
        ]);

        // Fetch the inserted/updated order to get the order ID
        $order = DB::table('orders')->where('transaction_id', $post_data['tran_id'])->first();
        $user = Auth::user();
        if($order){
            notify($user, 'Order_Confirm', [
                'subject' => "Your order is placed successfully",
                'orderId' => $order->transaction_id,
                'address' => $order->address_one. ','. $order->city.','. $order->state.','. $order->zip_code.','.$order->country,
                'ordertime' => $order->created_at,
                'name' => $order->name,
                'invoicelink' => route('addToCart.invoice',$order->id),
                'orderlink' => route('ego.single.orders',$order->id),
            ], ['email']);
        }
        // Save order items
        foreach ($carts as $cart) {
            $orderItem = new OrderItems();

            $orderItem->order_id = $order->id;  // Use the fetched order ID
            $orderItem->product_id = $cart->product_id;
            $orderItem->power = $cart->power;
            $orderItem->pair = $cart->pair;
            $orderItem->price = ($cart->power_type == 'with_power' ? $cart->product->price : $cart->product->no_power_price) * $cart->pair;


            if ($orderItem->save()) {
                $cart->delete();
            }
        }

        // Check if payment method is COD
        if ($request->payment_method == 'cod') {

            return redirect('/')->with('orderSuccess', 'Order placed successfully');
        }

        // For SSLCommerz payment method
        if ($request->payment_method == 'ssl') {
            $sslc = new SslCommerzNotification();
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            } else {
                return redirect('/')->with('orderSuccess', 'Order placed successfully');
            }
        }
    }

    public function payViaAjax(Request $request)
    {

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        'status' => 'Processing',
                        'payment_status' => 'paid'
                    ]);

                return redirect('/')->with('success', 'Order made successfully');
                echo "<br >Transaction is successfully Completed";
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

            return redirect('/')->with('success', 'Order made successfully');
            echo "Transaction is successfully Completed";
        } else {
            echo "Invalid Transaction";
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);

            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
