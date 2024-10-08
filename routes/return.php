<?php

use Illuminate\Support\Facades\Route;

Route::controller('ReturnProductController')->group(function () {
    Route::post('/make-return','makeReturn')->name('make');
    Route::get('/returned-products','showReturns')->name('show');

    Route::get('/all-returned','index')->name('admin.index');
    Route::post('/change-return-status/{id}','changeStatus')->name('admin.status.change');
});
