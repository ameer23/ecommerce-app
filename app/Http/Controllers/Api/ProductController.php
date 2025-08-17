<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class ProductController extends Controller
{

    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return $this->successResponse($products, 'Products retrieved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): ProductResource
{
    
    $product->load('category', 'reviews');

    return new ProductResource($product);
}
}