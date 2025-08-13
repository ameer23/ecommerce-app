<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Create a new order from a user's cart items.
     *
     * @param User $user
     * @return Order|null
     */
    public function createOrderFromCart(User $user): ?Order
    {
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return null;
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return DB::transaction(function () use ($user, $cartItems, $total) {
            $order = $user->orders()->create([
                'total_price' => $total,
            ]);

            foreach ($cartItems as $cartItem) {
                $order->items()->create([
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }

            $user->cartItems()->delete();

            return $order;
        });
    }
}