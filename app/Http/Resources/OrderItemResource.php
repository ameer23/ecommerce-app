<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'quantity' => $this->quantity,
            'price_at_purchase' => number_format($this->price, 2),
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}