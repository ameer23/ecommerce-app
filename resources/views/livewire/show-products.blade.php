<div class="bg-white">
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold mb-4">Discover products</h1>
            <div class="flex justify-center space-x-2 md:space-x-4">
                <button wire:click="filterByCategory(null)"
                    class="{{ is_null($selectedCategory) ? 'bg-black text-white' : 'bg-gray-200 text-gray-700' }} px-4 md:px-6 py-2 rounded-lg transition">All</button>

                @foreach($categories as $category)
                    <button wire:click="filterByCategory('{{ $category }}')"
                        class="{{ $selectedCategory === $category ? 'bg-black text-white' : 'bg-gray-200 text-gray-700' }} px-4 md:px-6 py-2 rounded-lg transition">{{ $category }}</button>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($products as $product)
                <div class="text-center">
                    <div class="bg-gray-100 rounded-lg p-6 mb-4">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-contain">
                    </div>
                    <h2 class="text-xl font-bold">{{ $product->name }}</h2>
                    <p class="text-gray-500 mb-2">{{ $product->formatted_price }}</p>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    <p>No products found in this category.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>