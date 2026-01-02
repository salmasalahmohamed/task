<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('register',[\App\Http\Controllers\AuthController::class,'adminRegister']);
Route::post('login',[\App\Http\Controllers\AuthController::class,'adminLogin']);
