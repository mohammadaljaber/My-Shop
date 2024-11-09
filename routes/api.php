<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;



require __DIR__.'/auth.php';

Route::group(['prefix'=>'v1','middleware'=>'auth:sanctum'],function(){

});
