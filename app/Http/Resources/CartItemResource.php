<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'cart_item_id' => $this->id,
            'quantity' => $this->quantity,
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'price' => $this->product->price,
            ],
            'item_total_price' => $this->quantity * $this->product->price,
        ];
    }
}