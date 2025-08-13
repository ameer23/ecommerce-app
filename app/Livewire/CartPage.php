<?php

namespace App\Livewire;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.app')]
class CartPage extends Component
{
    public $cartItems = [];
    public $total = 0;

    public function mount()
    {
        $this->updateCart();
    }

    public function updateCart()
    {
        $this->cartItems = Auth::user()->cartItems()->with('product')->get();
        $this->total = $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    public function incrementQuantity(int $cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);
        if ($cartItem && $cartItem->user_id === Auth::id()) {
            $cartItem->increment('quantity');
            $this->updateCart();
            $this->dispatch('cart-updated');
        }
    }

    public function decrementQuantity(int $cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);
        if ($cartItem && $cartItem->user_id === Auth::id()) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }
            $this->updateCart();
            $this->dispatch('cart-updated');
        }
    }

    public function removeItem(int $cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);
        if ($cartItem && $cartItem->user_id === Auth::id()) {
            $cartItem->delete();
            $this->updateCart();
            $this->dispatch('cart-updated');
        }
    }

    public function placeOrder()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return; 
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        DB::transaction(function () use ($cartItems, $total) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
            ]);

            foreach ($cartItems as $cartItem) {
                $order->items()->create([
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }

            Auth::user()->cartItems()->delete();
        });

        $this->dispatch('cart-updated');

        return $this->redirect('/order-confirmation', navigate: true);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}