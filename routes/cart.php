<?php

use App\Http\Controllers\EgoAdmin\CartController;
use Illuminate\Support\Facades\Route;

Route::controller(CartController::class)->group(function () {
    Route::post('/add-to-cart', 'addToCart')->name('add');
    Route::get('/get-cart-items', 'cartItems')->name('items');
    Route::get('/get-cart-count', 'getCartCount')->name('count');
    Route::get('/total-price', 'getCartTotalPrice')->name('total');
    Route::post('/update-quantity', 'updateCartQuantity')->name('updateQuantity');
    Route::delete('/delete-cart/{id}', 'deleteCart')->name('delete');
    Route::get('/get-accessories/count/', 'getAccessoryQuantity')->name('accessories.count');
});
