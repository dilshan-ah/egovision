<?php

use Illuminate\Support\Facades\Route;

Route::controller('InstagramController')->group(function () {
    Route::get('/insta-users', 'user')->name('user.index');
    Route::get('/create-insta-users', 'createUser')->name('user.create');
    Route::post('/store-insta-users', 'storeUser')->name('user.store');
    Route::get('/edit-insta-users/{id}', 'editUser')->name('user.edit');
    Route::post('/update-insta-users/{id}', 'updateUser')->name('user.update');
    Route::delete('/delete-insta-users/{id}', 'deleteUser')->name('user.delete');

    Route::get('/insta-posts', 'managePost')->name('user.managePost');
    Route::get('/create-insta-posts', 'createPost')->name('user.createPost');
    Route::get('/user/posts/{userId}', 'fetchPosts');
    Route::post('/store-insta-posts', 'storePost')->name('post.store');
    Route::delete('/delete-insta-post/{id}', 'deletePost')->name('post.delete');
});