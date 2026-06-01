<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/posts/{slug}', [\App\Http\Controllers\PostController::class, 'show'])
    ->name('posts.show');


Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard/',
    'middleware' => ['auth:web', 'verified'],
], function () {

    Route::resource('posts', PostController::class);
});
