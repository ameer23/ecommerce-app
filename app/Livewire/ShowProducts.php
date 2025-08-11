<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ShowProducts extends Component
{
    public ?string $selectedCategory = null;

    public function filterByCategory(?string $category)
    {
        $this->selectedCategory = $category;
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->selectedCategory, function ($query) {
                $query->where('category', $this->selectedCategory);
            })
            ->get();

        return view('livewire.show-products', [
            'products' => $products,
            'categories' => ['Chairs', 'Electronics'] // We can make this dynamic later
        ]);
    }
}