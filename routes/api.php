<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;




// PUBLIC API ROUTES
Route::get('/products', [ProductController::class, 'index']); // Assuming you'll create an index method
Route::get('/products/{product}', [ProductController::class, 'show']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// PROTECTED API ROUTES
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/cart', [CartController::class, 'store']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy']);



    // We will build these endpoints next. For now, they are
    // correctly placed inside the protected group.
    // Route::delete('/cart/{id}', [CartController::class, 'destroy']);
    // Route::post('/orders', [OrderController::class, 'store']);
    // Route::post('/logout', [AuthController::class, 'logout']);

});