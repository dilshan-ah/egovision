<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\CollectionSet;
use App\Models\Duration;
use App\Models\EgoModels\Banner;
use App\Models\EgoModels\BaseCurve;
use App\Models\EgoModels\Color;
use App\Models\EgoModels\Diameter;
use App\Models\EgoModels\LensDesign;
use App\Models\EgoModels\Material;
use App\Models\EgoModels\Order;
use App\Models\EgoModels\Product;
use App\Models\EgoModels\ProductCategory;
use App\Models\EgoModels\Replacement;
use App\Models\EgoModels\Tone;
use App\Models\EgoModels\Wishlist;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Page;
use App\Models\Subscriber;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{

    public function placeholderImage($size = null)
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font/RobotoMono-Regular.ttf');
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance()
    {
        $pageTitle = 'Maintenance Mode';
        $general = gs();
        if ($general->maintenance_mode == Status::DISABLE) {
            return to_route('home');
        }
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view($this->activeTemplate . 'maintenance', compact('pageTitle', 'maintenance'));
    }

    public function policyPages($id, $slug)
    {
        $policy = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        return view('templates.basic.policy', compact('policy', 'pageTitle'));
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        return view('contact', compact('pageTitle'));
    }

    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        $request->session()->regenerateToken();

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = Status::PRIORITY_MEDIUM;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = Status::TICKET_OPEN;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function egoIndex()
    {
        $pageTitle = "Ego Vision-Home";
        $banners = Banner::all();
        $colors = Color::has('products')->with('products')->get();

        // $products = Product::with('color', 'category', 'tone')->get();

        $collectionSets = CollectionSet::with(['category', 'tone', 'duration'])
            ->where('featured', 'yes')
            ->get();

        foreach ($collectionSets as $collectionSet) {
            // Initialize the query for products
            $productsQuery = Product::query();

            // Add category filter (this is mandatory)
            $productsQuery->where('category_id', $collectionSet->category_id);

            // Add tone filter if tone_id exists
            if ($collectionSet->tone_id) {
                $productsQuery->where('tone_id', $collectionSet->tone_id);
            }

            // Add duration filter if duration_id exists
            if ($collectionSet->duration_id) {
                $productsQuery->where('duration_id', $collectionSet->duration_id);
            }

            // Fetch the products that match the query
            $products = $productsQuery->get();

            // Attach products as a child object (keep as objects, no conversion to array)
            $collectionSet->products = $products; // No ->toArray(), keep as Eloquent collection
        }

        $products = Product::with([
            'color',
            'category.collectionSet' => function ($query) {
                $query->where('featured', '!=', 'yes');
            }
        ])->take(10)->get();

        // Filter products where the related collectionSet's featured is not 'yes'
        $moreProducts = $products->filter(function ($product) {
            return $product->category && $product->category->collectionSet && $product->category->collectionSet->featured != 'yes';
        });

        // dd($moreProducts);


        return view('ego_index', compact('pageTitle', 'banners', 'colors', 'moreProducts', 'collectionSets'));
    }


    public function toricLense()
    {
        $pageTitle = "Toric Lense";
        return view('ego.pages.toric_lense', compact('pageTitle'));
    }
    public function collection()
    {
        $pageTitle = "collection";
        $collectionSets = CollectionSet::with('category', 'tone', 'duration')->get();
        return view('ego.pages.collection', compact('pageTitle', 'collectionSets'));
    }

    public function color()
    {
        $pageTitle = "color";
        $colors = Color::all();
        return view('ego.pages.color', compact('pageTitle', 'colors'));
    }
    public function duration()
    {
        $pageTitle = "Best Durations";
        $durations = Duration::all();

        return view('ego.pages.duration', compact('pageTitle', 'durations'));
    }
    public function about()
    {
        $pageTitle = "about";
        return view('ego.pages.about', compact('pageTitle'));
    }

    public function accessories()
    {
        $pageTitle = "Accessories";
        $products = Product::where('product_type','accessories')->with(['category', 'color', 'images'])->get();
        return view('ego.pages.accessories', compact('pageTitle','products'));
    }
    public function shopInstagram()
    {
        $pageTitle = "Shop Instagram";
        return view('ego.pages.shop_instagram', compact('pageTitle'));
    }

    public function allLenses(Request $request)
    {
        $pageTitle = "All Lenses";

        $products = Product::query();

        $colorQueries = $request->query('colors');
        $colorArray = $colorQueries ? explode(',', $colorQueries) : [];

        $baseQueries = $request->query('base');
        $baseArray = $baseQueries ? explode(',', $baseQueries) : [];

        $diameterQueries = $request->query('diameter');
        $diameterArray = $diameterQueries ? explode(',', $diameterQueries) : [];

        $toneQueries = $request->query('tones');
        $toneArray = $toneQueries ? explode(',', $toneQueries) : [];

        $replacementQueries = $request->query('replacement');
        $replacementArray = $replacementQueries ? explode(',', $replacementQueries) : [];

        $materialQueries = $request->query('material');
        $materialArray = $materialQueries ? explode(',', $materialQueries) : [];

        $lensQueries = $request->query('lens');
        $lensArray = $lensQueries ? explode(',', $lensQueries) : [];

        if (!empty($colorArray)) {
            $products->whereIn('color_id', $colorArray);
        }

        if (!empty($baseArray)) {
            $products->whereIn('base_curve_id', $baseArray);
        }

        if (!empty($diameterArray)) {
            $products->whereIn('diameter_id', $diameterArray);
        }

        if (!empty($toneArray)) {
            $products->whereIn('tone_id', $toneArray);
        }

        if (!empty($replacementArray)) {
            $products->whereIn('duration_id', $replacementArray);
        }

        if (!empty($materialArray)) {
            $products->whereIn('material_id', $materialArray);
        }

        if (!empty($lensArray)) {
            $products->whereIn('lens_design_id', $lensArray);
        }

        $products = $products->get();

        $colors = Color::all();
        $baseCurves = BaseCurve::all();
        $diameters = Diameter::all();
        $tones = Tone::all();
        $replacements = Duration::all();
        $materials = Material::all();
        $lenses = LensDesign::all();

        // dd($toneArray);

        return view('ego.pages.all_lenses', compact('pageTitle', 'products', 'colors', 'baseCurves', 'diameters', 'tones', 'replacements', 'materials', 'lenses', 'colorArray', 'baseArray', 'diameterArray', 'toneArray', 'replacementArray', 'materialArray', 'lensArray'));
    }



    public function egoLogin()
    {
        $pageTitle = "Ego Vision User Login";
        return view('ego.auth.login', compact('pageTitle'));
    }
    public function egoRegister()
    {
        $pageTitle = "Ego Vision User Register";
        $response = Http::withOptions([
            'verify' => realpath('C:\\xampp\\php\\extras\\ssl\\cacert.pem')
        ])->get('https://countriesnow.space/api/v0.1/countries/states');       

        $data = $response->json();
        $states = $data['data'][18];
        return view('ego.auth.register', compact('pageTitle','states'));
    }

    public function testUser()
    {
        $pageTitle = "User Dashboard";
        return view('layouts.userTamplate', compact('pageTitle'));
    }

    public function wishlist()
    {
        $pageTitle = "WishLists";
        $userId = Auth::id();
        $wishlists = Wishlist::where('user_id', $userId)
        ->get();

        return view('user.wishlist.wishlist', compact('pageTitle','wishlists'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $pageTitle = "Search result for ".$query;

        $products = Product::where('name', 'LIKE', '%' . $query . '%')->get();

        return view('ego.pages.search', compact('products','query','pageTitle'));
    }

    public function myOrders()
    {
        $pageTitle = "My Orders";
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)->with('orderItems.product')
        ->get();

        return view('user.order.index', compact('pageTitle','orders'));
    }

    public function singleOrder(string $id)
    {
        $pageTitle = 'Order Details | Order';
        $order = Order::find($id)->first();

        return view('user.order.view',compact('order','pageTitle'));
    }

    public function newsLetter()
    {
        $pageTitle = 'Newsletter Subscription';
        $subscribed = Subscriber::where('email',Auth::user()->email)->first();
        return view('user.news_letter',compact('pageTitle','subscribed'));
    }

    public function giftCard()
    {
        $pageTitle = 'Gift Card';
        return view('user.gift_card',compact('pageTitle'));
    }
}
