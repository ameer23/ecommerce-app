<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Your Shopping Cart</h1>

    @if(count($cartItems) > 0)
        <div class="bg-white p-6 rounded-lg shadow-md">
            @foreach($cartItems as $item)
                <div class="flex items-center justify-between py-4 border-b">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-contain rounded-md">
                        <div>
                            <p class="font-semibold">{{ $item->product->name }}</p>
                            <p class="text-gray-600">${{ number_format($item->product->price, 2) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <button wire:click="decrementQuantity({{ $item->id }})" class="px-2 py-1 bg-gray-200 rounded">-</button>
                            <span>{{ $item->quantity }}</span>
                            <button wire:click="incrementQuantity({{ $item->id }})" class="px-2 py-1 bg-gray-200 rounded">+</button>
                        </div>
                        <p class="font-semibold">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        <button wire:click="removeItem({{ $item->id }})" class="text-red-500 hover:text-red-700">Remove</button>
                    </div>
                </div>
            @endforeach

            <div class="mt-6 text-right">
                <p class="text-2xl font-bold">Total: ${{ number_format($total, 2) }}</p>
                <button wire:click="placeOrder" class="mt-4 bg-black text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800">
                Proceed to Checkout
                </button>
            </div>
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p class="text-gray-600">Your cart is empty.</p>
            <a href="/" class="mt-4 inline-block bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800">Continue Shopping</a>
        </div>
    @endif
</div>