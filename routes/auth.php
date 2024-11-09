<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('userRegister',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('verify\{id}',[AuthController::class,'verify'])->name('verify');
Route::get('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
