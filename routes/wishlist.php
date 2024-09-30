<?php

use App\Http\Controllers\EgoAdmin\WishlistController;
use Illuminate\Support\Facades\Route;

Route::controller( WishlistController::class)->group(function () {
    Route::post('/add-to-wishlist/{id}', 'store')->name('add')->middleware('auth');
    Route::delete('/delete-to-wishlist/{id}', 'delete')->name('delete')->middleware('auth');
});