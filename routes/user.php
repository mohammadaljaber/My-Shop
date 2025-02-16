<?php

use App\Http\Controllers\Api\V1\Brand\BrandController;
use App\Http\Controllers\Api\V1\Category\CategoryController;
use App\Http\Controllers\Api\V1\Order\OrderController;
use App\Http\Controllers\Api\V1\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('categories',[CategoryController::class,'index']);
Route::post('brands',[BrandController::class,'index']);
Route::post('products',[ProductController::class,'index']);
Route::get('stocks/{product}',[ProductController::class,'getStocks']);
Route::post('newOrder',[OrderController::class,'store']);
