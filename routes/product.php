<?php

use Illuminate\Support\Facades\Route;

Route::controller('ProductController')->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::get('/edit-accessory/{id}', 'editAccessory')->name('edit.accessory');
    Route::post('/update/{id}', 'update')->name('update');
    Route::post('/update-accessory/{id}', 'updateAccessories')->name('update.accessory');
    Route::get('/delete/{id}', 'destroy')->name('delete');
    Route::get('/create/accessories', 'createAccessories')->name('create.accessories');
    Route::post('/store/accessories', 'storeAccessories')->name('store.accessories');
    Route::get('/accessories', 'allAccessories')->name('accessories');
});
