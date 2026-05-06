<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/posts/{id}/{slug?}', [PostController::class, 'show'])
    ->where([
        'slug' => '[a-z0-9\-]+',
        'id' => '[0-9]+',
    ]);

Route::get('/posts', [PostController::class, 'index']);
