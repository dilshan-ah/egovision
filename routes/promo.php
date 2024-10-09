<?php

use Illuminate\Support\Facades\Route;

Route::controller('PromoCodeController')->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'delete')->name('delete');
    Route::post('/promo/verify', 'verifyPromo')->name('verify');

});
