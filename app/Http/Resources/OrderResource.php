<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total' => number_format($this->total_price, 2),
            'status' => $this->status,
            'created_at' => $this->created_at->toFormattedDateString(),
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
        ];
    }
}