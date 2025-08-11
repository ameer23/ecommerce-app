<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;



// PUBLIC API ROUTES
// Anyone can access these endpoints without a token.
Route::get('/products', [ProductController::class, 'index']); // Assuming you'll create an index method
Route::get('/products/{product}', [ProductController::class, 'show']);

// TODO: Add public routes for registration and login here later.


// PROTECTED API ROUTES
// A valid API token is required to access these endpoints.
Route::middleware('auth:sanctum')->group(function () {

    // This route is for the currently authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // We will build these endpoints next. For now, they are
    // correctly placed inside the protected group.
    // Route::post('/cart', [CartController::class, 'store']);
    // Route::delete('/cart/{id}', [CartController::class, 'destroy']);
    // Route::post('/orders', [OrderController::class, 'store']);
    // Route::post('/logout', [AuthController::class, 'logout']);

});