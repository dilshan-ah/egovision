<?php

use Illuminate\Support\Facades\Route;

Route::controller('ColorController')->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::get('/delete/{id}', 'destroy')->name('delete');
    Route::get('/colors/{id}', 'singleColor')->name('single.color');
});
