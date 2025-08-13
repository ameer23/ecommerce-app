<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\ProductCategory;

 

class Product extends Model
{
    use HasFactory;

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => '$' . number_format($this->price, 2),
        );
    }


    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected $casts = [
        'category' => ProductCategory::class, 
    ];
}