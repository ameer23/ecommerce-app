<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowProducts extends Component
{
    public ?string $selectedCategory = null;

    public function filterByCategory(?string $category)
    {
        $this->selectedCategory = $category;
    }

    public function confirmAddToCart(int $productId)
    {
        if (!Auth::check()) {
            session()->flash('info', 'You must be logged in to add items to your cart.');
            return $this->redirect('/login');
        }

        $existingCartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        $this->dispatch('cart-updated');
    }

    public function render()
{
    $products = Product::query()
        ->when($this->selectedCategory, function ($query) {
            $query->where('category', $this->selectedCategory);
        })
        ->get();

    $categories = Product::query()
        ->whereNotNull('category')
        ->distinct()
        ->pluck('category');

    return view('livewire.show-products', [
        'products' => $products,
        'categories' => $categories 
    ]);
}

    
}