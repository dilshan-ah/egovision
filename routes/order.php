<?php

use Illuminate\Support\Facades\Route;

Route::controller('OrderController')->group(function () {
    Route::get('/index/{id}', 'index')->name('index');
    Route::get('/checkout', 'checkout')->name('checkout')->middleware('auth');

});
