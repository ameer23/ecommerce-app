<div
    x-data="{
        showConfirmationModal: false,
        productToAdd: null
    }"
    class="bg-white"
>
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
                <div class="text-center flex flex-col">
                    <div class="bg-gray-100 rounded-lg p-6 mb-4 flex-grow">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-contain">
                    </div>
                    <h2 class="text-xl font-bold">{{ $product->name }}</h2>
                    <p class="text-gray-500 mb-4">{{ $product->formatted_price }}</p>

                    <button
                        @click="productToAdd = {{ json_encode($product) }}; showConfirmationModal = true"
                        class="mt-auto bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition">
                        Add to Cart
                    </button>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    <p>No products found in this category.</p>
                </div>
            @endforelse
        </div>
    </div>

    <template x-if="showConfirmationModal">
        <div
            @click.self="showConfirmationModal = false"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50"
        >
            <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md">
                <h3 class="text-xl font-bold mb-4">Add to Cart</h3>
                <div class="flex items-center space-x-4 mb-6">
                    <img :src="productToAdd.image_url" :alt="productToAdd.name" class="w-24 h-24 object-contain rounded-lg bg-gray-100">
                    <div>
                        <p class="font-semibold" x-text="productToAdd.name"></p>
                        <p class="text-gray-700" x-text="productToAdd.formatted_price"></p>
                    </div>
                </div>
                <div class="flex justify-end space-x-4">
                    <button @click="showConfirmationModal = false" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                    <button
                        @click="$wire.confirmAddToCart(productToAdd.id); showConfirmationModal = false"
                        class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800">Confirm & Add</button>
                </div>
            </div>
        </div>
    </template>
</div>