<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

//products - list/detail

Route::get('/products', [\App\Http\Controllers\Api\ProductsController::class, 'products']);
Route::get('/products/{id}', [\App\Http\Controllers\Api\ProductsController::class, 'product']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [\App\Http\Controllers\Api\ProfileController::class, 'user']);


});
