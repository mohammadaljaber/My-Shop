<?php

use App\Http\Controllers\Api\V1\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::post('categories',[CategoryController::class,'index']);
