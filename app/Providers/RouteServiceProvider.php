<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::namespace($this->namespace)->group(function () {
                Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('routes/api.php'));

                Route::middleware('web')
                    ->group(base_path('routes/web.php'));

                Route::middleware(['web', 'maintenance'])
                    ->prefix('user')
                    ->group(base_path('routes/user.php'));

                Route::middleware(['web'])
                    ->namespace('Admin')
                    ->prefix('admin')
                    ->name('admin.')
                    ->group(base_path('routes/admin.php'));
                Route::middleware(['web', 'maintenance'])
                    ->namespace('Gateway')
                    ->prefix('ipn')
                    ->name('ipn.')
                    ->group(base_path('routes/ipn.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/banner')
                    ->name('banner.')
                    ->group(base_path('routes/banner.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/category')
                    ->name('category.')
                    ->group(base_path('routes/category.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/product')
                    ->name('product.')
                    ->group(base_path('routes/product.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/color')
                    ->name('color.')
                    ->group(base_path('routes/color.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/diameter')
                    ->name('diameter.')
                    ->group(base_path('routes/diameter.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/duration')
                    ->name('duration.')
                    ->group(base_path('routes/duration.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/replacement')
                    ->name('replacement.')
                    ->group(base_path('routes/replacement.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/material')
                    ->name('material.')
                    ->group(base_path('routes/material.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/tone')
                    ->name('tone.')
                    ->group(base_path('routes/tone.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/baseCurve')
                    ->name('baseCurve.')
                    ->group(base_path('routes/baseCurve.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('admin/lensDesign')
                    ->name('lensDesign.')
                    ->group(base_path('routes/lensDesign.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('addToCart')
                    ->name('addToCart.')
                    ->group(base_path('routes/order.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('water_content')
                    ->name('water_content.')
                    ->group(base_path('routes/waterContent.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('collectionSet')
                    ->name('collectionSet.')
                    ->group(base_path('routes/collectionSet.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('lensPower')
                    ->name('lensPower.')
                    ->group(base_path('routes/lensPower.php'));  
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('cart')
                    ->name('cart.')
                    ->group(base_path('routes/cart.php'));   
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('wishlist')
                    ->name('wishlist.')
                    ->group(base_path('routes/wishlist.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('return')
                    ->name('return.')
                    ->group(base_path('routes/return.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('promo')
                    ->name('promo.')
                    ->group(base_path('routes/promo.php'));
                Route::middleware('web')
                    ->namespace('EgoAdmin')
                    ->prefix('shipping')
                    ->name('shipping.')
                    ->group(base_path('routes/shipping.php'));         
            });
        });
    }
}
