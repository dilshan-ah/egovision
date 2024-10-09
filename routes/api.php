<?php

use App\Http\Controllers\Api\EgoVisionControllers\AuthController;
use App\Http\Controllers\Api\EgoVisionControllers\BannerController;
use App\Http\Controllers\Api\EgoVisionControllers\CartController;
use App\Http\Controllers\Api\EgoVisionControllers\CategoryController;
use App\Http\Controllers\Api\EgoVisionControllers\CollectionSetController;
use App\Http\Controllers\Api\EgoVisionControllers\ColorController;
use App\Http\Controllers\Api\EgoVisionControllers\DurationController;
use App\Http\Controllers\Api\EgoVisionControllers\FilterController;
use App\Http\Controllers\Api\EgoVisionControllers\OrderController;
use App\Http\Controllers\Api\EgoVisionControllers\PrescriptionController;
use App\Http\Controllers\Api\EgoVisionControllers\ProductController;
use App\Http\Controllers\Api\EgoVisionControllers\ReturnProductController;
use App\Http\Controllers\Api\EgoVisionControllers\TicketController;
use App\Http\Controllers\Api\EgoVisionControllers\WishlistController;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('ego/register', 'register');
    Route::post('ego/login', 'login');
    Route::post('ego/logout', 'logout')->middleware('auth:sanctum');
    Route::get('ego/get/districts', 'getDistricts');
});

// Product
Route::controller(ProductController::class)->group(function () {
    Route::get('ego/products', 'getProducts');
    Route::get('ego/app/singleProduct/{id}', 'singleProduct');
    Route::get('ego/accessories', 'getAccessories');
});


// Banner
Route::controller(BannerController::class)->group(function () {
    Route::get('ego/banners', 'getBanners');
    Route::get('app/ego/banners', 'getBannerForApp');
});


// Color
Route::controller(ColorController::class)->group(function () {
    Route::get('app/ego/dashboard/colors', 'getDashColor');
    Route::get('app/ego/page/colors', 'getPageColor');
    Route::get('app/ego/singleColor/{id}', 'singleColor');
});


Route::controller(CollectionSetController::class)->group(function () {
    Route::get('app/ego/menu/collectionSets', 'collectionMenu');
    Route::get('app/ego/page/collectionSets', 'collectionPage');
    Route::get('app/ego/page/singleCollection/{id}', 'singleCollection');
    Route::get('app/ego/featured/collectionSets', 'featuredCollection');
    Route::get('app/ego/moreProducts', 'moreProducts');
});

// Category
Route::controller(CategoryController::class)->group(function () {
    Route::get('app/ego/categories', 'getCategory');
    Route::get('app/ego/singleCategory/{id}', 'singleCategory');
});

Route::controller(DurationController::class)->group(function () {
    Route::get('app/ego/menu/durations', 'getDurations');
    Route::get('app/ego/page/durations', 'getDurationPage');
    Route::get('app/ego/single/durations/{id}', 'singleDuration');
});

Route::controller(FilterController::class)->group(function () {
    Route::get('app/ego/filters/all', 'filter');
});

Route::controller(CartController::class)->group(function () {
    Route::post('app/addToCart', 'addToCart');
    Route::get('app/getCart/{id}', 'userCartList');
});

Route::controller(OrderController::class)->group(function () {
    Route::post('app/placeOrder', 'store');
    Route::get('app/user/oreders/{userid}', 'userOrder');
    Route::get('app/user/orederDetails/{productid}', 'singleOrder');
});

Route::controller(WishlistController::class)->group(function(){
    Route::get('app/user/wishlists/{id}','userWishList');
    Route::post('app/user/add-wishlists/{productid}/{userId}','store');
    Route::delete('app/user/delete-wishlists/{userId}','delete');
});

Route::controller(TicketController::class)->group(function(){
    Route::get('app/user/tickets/{id}','userTickets');
    Route::get('app/user/ticket/view/{ticketId}','singleTicket');
    Route::post('app/user/ticket/store/{userId}','contactSubmit');
    Route::post('app/user/ticket/reply/{ticketId}/{userId}','replyTicketApi');
});

Route::controller(PrescriptionController::class)->group(function(){
    Route::get('app/user/prescription/{id}','showPrescription');
    Route::post('app/user/prescription/upload/{id}','uploadPrescriptionSubmit');
});

Route::controller(ReturnProductController::class)->group(function(){
    Route::get('app/user/returned-products/{userId}','myReturns');
    Route::post('app/user/return-make','makeReturn');
});

Route::namespace('Api')->name('api.')->group(function () {

    Route::get('general-setting', function () {
        $general = GeneralSetting::first();
        $notify[] = 'General setting data';
        return response()->json([
            'remark' => 'general_setting',
            'status' => 'success',
            'message' => ['success' => $notify],
            'data' => [
                'general_setting' => $general,
            ],
        ]);
    });

    Route::get('get-countries', function () {
        $c = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $notify[] = 'General setting data';
        foreach ($c as $k => $country) {
            $countries[] = [
                'country' => $country->country,
                'dial_code' => $country->dial_code,
                'country_code' => $k,
            ];
        }
        return response()->json([
            'remark' => 'country_data',
            'status' => 'success',
            'message' => ['success' => $notify],
            'data' => [
                'countries' => $countries,
            ],
        ]);
    });

    Route::namespace('Auth')->group(function () {
        Route::post('login', 'LoginController@login');
        Route::post('register', 'RegisterController@register');

        Route::controller('ForgotPasswordController')->group(function () {
            Route::post('password/email', 'sendResetCodeEmail')->name('password.email');
            Route::post('password/verify-code', 'verifyCode')->name('password.verify.code');
            Route::post('password/reset', 'reset')->name('password.update');
        });
    });

    Route::controller('UserController')->group(function () {
        Route::post('user-data-submit/{userId}', 'userDataSubmit');
    });

    Route::middleware('auth:sanctum')->group(function () {

        //authorization
        Route::controller('AuthorizationController')->group(function () {
            Route::get('authorization', 'authorization')->name('authorization');
            Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
            Route::post('verify-email', 'emailVerification')->name('verify.email');
            Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
            Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
        });

        

        Route::middleware(['check.status'])->group(function () {
            // Route::post('user-data-submit/{userId}', 'UserController@userDataSubmit')->name('data.submit');

            Route::middleware('registration.complete')->group(function () {
                Route::get('dashboard', function () {
                    return auth()->user();
                });

                Route::get('user-info', function () {
                    $notify[] = 'User information';
                    return response()->json([
                        'remark' => 'user_info',
                        'status' => 'success',
                        'message' => ['success' => $notify],
                        'data' => [
                            'user' => auth()->user()
                        ]
                    ]);
                });

                Route::controller('UserController')->group(function () {
                    // User data
                    // Route::post('user-data-submit/{userId}', 'userDataSubmit');
                    //KYC
                    Route::get('kyc-form', 'kycForm')->name('kyc.form');
                    Route::post('kyc-submit', 'kycSubmit')->name('kyc.submit');

                    //Report
                    Route::any('deposit/history', 'depositHistory')->name('deposit.history');
                    Route::get('transactions', 'transactions')->name('transactions');
                });

                //Profile setting
                Route::controller('UserController')->group(function () {
                    Route::post('profile-setting', 'submitProfile');
                    Route::post('change-password', 'submitPassword');
                });

                // Withdraw
                Route::controller('WithdrawController')->group(function () {
                    Route::get('withdraw-method', 'withdrawMethod')->name('withdraw.method')->middleware('kyc');
                    Route::post('withdraw-request', 'withdrawStore')->name('withdraw.money')->middleware('kyc');
                    Route::post('withdraw-request/confirm', 'withdrawSubmit')->name('withdraw.submit')->middleware('kyc');
                    Route::get('withdraw/history', 'withdrawLog')->name('withdraw.history');
                });

                // Payment
                Route::controller('PaymentController')->group(function () {
                    Route::get('deposit/methods', 'methods')->name('deposit');
                    Route::post('deposit/insert', 'depositInsert')->name('deposit.insert');
                    Route::get('deposit/confirm', 'depositConfirm')->name('deposit.confirm');
                    Route::get('deposit/manual', 'manualDepositConfirm')->name('deposit.manual.confirm');
                    Route::post('deposit/manual', 'manualDepositUpdate')->name('deposit.manual.update');
                });
            });
        });

        Route::get('logout', 'Auth\LoginController@logout');
    });
});
