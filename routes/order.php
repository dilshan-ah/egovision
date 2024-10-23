<?php

use Illuminate\Support\Facades\Route;

Route::controller('OrderController')->group(function () {
    Route::get('/index/{id}', 'index')->name('index');
    Route::get('/checkout', 'checkout')->name('checkout')->middleware('auth');

    //Admin routes
    Route::get('/manage-orders','indexadmin')->name('admin.index');
    Route::post('/change-status/{id}','updateStatus')->name('admin.change.status');
    Route::get('/orders-details/{id}','viewOrder')->name('admin.view.order');
    Route::post('/change-address/{id}','updateBilling')->name('admin.change.address');
    Route::post('/change-payment/{id}','updatePayment')->name('admin.change.payment');

    Route::get('/invoice/{id}','invoice')->name('invoice');
});
