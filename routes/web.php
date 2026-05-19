<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');


Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard/',
], function () {

    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
});
