<?php

use App\Enums\ApiDictionaryVisibleRoutes;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('products', ProductController::class)->only(ApiDictionaryVisibleRoutes::values());
});
