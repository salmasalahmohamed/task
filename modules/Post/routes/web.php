<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\controllers\PostController;

Route::middleware(['auth:sanctum', 'abilities:admin'])->group(function () {

    Route::post('posts', [PostController::class, 'store']);
    Route::post('posts/{post}', [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
   });

Route::get('posts', [PostController::class, 'index']);
