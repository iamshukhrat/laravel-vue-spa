<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/posts', \App\Http\Controllers\Api\PostController::class);
    Route::get('/categories', [\App\Http\Controllers\Api\CategoryController::class, 'index']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
//});
