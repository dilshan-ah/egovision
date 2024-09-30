<?php

namespace App\Providers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\CollectionSet;
use App\Models\Deposit;
use App\Models\Duration;
use App\Models\EgoModels\Color;
use App\Models\EgoModels\Product;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\SupportTicket;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\EgoModels\Cart;
use App\Models\EgoModels\Wishlist;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $general = gs();
        $viewShare['general'] = $general;
        // $viewShare['language'] = Language::all();
        $viewShare['emptyMessage'] = 'Data not found';
        view()->share($viewShare);


        view()->composer('admin.include.sidebar', function ($view) {
            $view->with([
                'bannedUsersCount'           => User::banned()->count(),
                'emailUnverifiedUsersCount' => User::emailUnverified()->count(),
                'mobileUnverifiedUsersCount'   => User::mobileUnverified()->count(),
                'kycUnverifiedUsersCount'   => User::kycUnverified()->count(),
                'kycPendingUsersCount'   => User::kycPending()->count(),
                'pendingDepositsCount'    => Deposit::pending()->count(),
                'pendingWithdrawCount'    => Withdrawal::pending()->count(),
                'pendingTicketCount'     => SupportTicket::whereIN('status', [Status::TICKET_OPEN, Status::TICKET_REPLY])->count(),
            ]);
        });

        view()->composer('admin.include.topbar', function ($view) {
            $view->with([
                'adminNotifications' => AdminNotification::where('is_read', Status::NO)->with('user')->orderBy('id', 'desc')->take(10)->get(),
                'adminNotificationCount' => AdminNotification::where('is_read', Status::NO)->count(),
            ]);
        });

        view()->composer('ego.include.header', function ($view) {
            $colors = Color::all();
            $view->with('colors', $colors);
        });

        view()->composer('ego.include.header', function ($view) {
            $durations = Duration::all();
            $view->with('durations', $durations);
        });

        view()->composer('ego.include.banner', function ($view) {
            $durations = Duration::all();
            $view->with('durations', $durations);
        });

        view()->composer('ego.include.header', function ($view) {
            $collectionSets = CollectionSet::with(['category', 'tone', 'duration'])
            ->get();

            foreach ($collectionSets as $collectionSet) {
                $productsQuery = Product::query();

                $productsQuery->where('category_id', $collectionSet->category_id);

                if ($collectionSet->tone_id) {
                    $productsQuery->where('tone_id', $collectionSet->tone_id);
                }

                if ($collectionSet->duration_id) {
                    $productsQuery->where('duration_id', $collectionSet->duration_id);
                }

                $products = $productsQuery->get();

                $collectionSet->products = $products;
            }
            $view->with('collectionSets', $collectionSets);
        });

        view()->composer('ego.include.banner', function ($view) {
            $collectionSets = CollectionSet::with(['category', 'tone', 'duration'])
            ->get();

            foreach ($collectionSets as $collectionSet) {
                $productsQuery = Product::query();

                $productsQuery->where('category_id', $collectionSet->category_id);

                if ($collectionSet->tone_id) {
                    $productsQuery->where('tone_id', $collectionSet->tone_id);
                }

                if ($collectionSet->duration_id) {
                    $productsQuery->where('duration_id', $collectionSet->duration_id);
                }

                $products = $productsQuery->get();

                $collectionSet->products = $products;
            }
            $view->with('collectionSets', $collectionSets);
        });

        view()->composer('ego.include.banner', function ($view) {
            $currentSessionId = Session::getId();

            if(Auth::check())
            {
                $carts = Cart::where('user_id', Auth::user()->id)->get();
            }else{
                $carts = Cart::where('session_id', $currentSessionId)->get();
            }
            
            $view->with('carts', $carts);
        });

        view()->composer('ego.include.header', function ($view) {
            $currentSessionId = Session::getId();

            if(Auth::check())
            {
                $carts = Cart::where('user_id', Auth::user()->id)->get();
            }else{
                $carts = Cart::where('session_id', $currentSessionId)->get();
            }
            
            $view->with('carts', $carts);
        });

        view()->composer('ego.include.banner', function ($view) {
            @$wishlists = Wishlist::where('user_id',Auth::user()->id)->get();
            
            @$view->with('wishlists', $wishlists);
        });

        view()->composer('ego.include.header', function ($view) {
            @$wishlists = Wishlist::where('user_id',Auth::user()->id)->get();
            
            @$view->with('wishlists', $wishlists);
        });

        Paginator::useBootstrapFour();
    }
}
