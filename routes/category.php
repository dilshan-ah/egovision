<?php

use Illuminate\Support\Facades\Route;

Route::controller('CategoryController')->group(function () {
    Route::get('/view', 'index')->name('view');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::get('/delete/{id}', 'destroy')->name('delete');
    // Route::get('/collection/lense/{id}', 'singleCollection')->name('single.category');
});
