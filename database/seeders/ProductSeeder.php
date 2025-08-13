<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    Product::create([
        'name' => 'High-Performance Laptop',
        'description' => 'A top-tier laptop for professionals and gamers.',
        'price' => 1499.99,
        'category' => 'Electronics',
        'image_url' => 'https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
    ]);

    Product::create([
        'name' => 'Wireless Mechanical Keyboard',
        'description' => 'A clicky and satisfying keyboard for typing enthusiasts.',
        'price' => 129.99,
        'category' => 'Electronics',
        'image_url' => 'https://images.pexels.com/photos/841228/pexels-photo-841228.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
    ]);

    Product::create([
        'name' => 'Modern Ergonomic Chair',
        'description' => 'A stylish chair designed for comfort and support.',
        'price' => 399.50,
        'category' => 'Chairs',
        'image_url' => 'https://images.pexels.com/photos/2762247/pexels-photo-2762247.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
    ]);

    Product::create([
    'name' => '4K Ultra-Wide Monitor',
    'description' => 'An immersive display for productivity and entertainment.',
    'price' => 799.50,
    'category' => 'Monitors', 
    'image_url' => 'https://images.pexels.com/photos/1999463/pexels-photo-1999463.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
]);
}
}
