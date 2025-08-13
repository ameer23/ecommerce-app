<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Services\OrderService;

class OrderController extends Controller
{

    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, OrderService $orderService) 
    {
        $order = $orderService->createOrderFromCart($request->user());

        if (!$order) {
            return $this->errorResponse('Your cart is empty.', 422);
        }

        $order->load('items.product');

        return $this->successResponse(new OrderResource($order), 'Order placed successfully.');
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
    public function destroy(string $id)
    {
        //
    }
}
