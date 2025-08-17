<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use Illuminate\Http\Request;
use \App\Traits\ApiResponse;


class CartController extends Controller
{

        use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $cartItems = $user->cartItems()->with('product')->get();

        return $this->successResponse(
            CartItemResource::collection($cartItems),
            'Cart items retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(StoreCartItemRequest $request)
    {
        // Get the validated data as an array
        $validatedData = $request->validated();
        $productId = $validatedData['product_id'];
        $quantity = $validatedData['quantity'];

        // The user() method on the request is correct
        $user = $request->user();

        // Check if the item already exists in the cart
        $cartItem = $user->cartItems()->where('product_id', $productId)->first();

        if ($cartItem) {
            // If it exists, update the quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // If not, create a new cart item
            $cartItem = $user->cartItems()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        // Load the product relationship to include it in the resource
        $cartItem->load('product');

        return $this->successResponse(
            new CartItemResource($cartItem),
            'Product added to cart successfully.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, CartItem $cartItem)
    {
        if ($request->user()->id !== $cartItem->user_id) {
            return $this->errorResponse('You are not authorized to perform this action.', 403);
        }

        $cartItem->delete();

        return $this->successResponse(null, 'Item removed from cart successfully.');
    }
}
