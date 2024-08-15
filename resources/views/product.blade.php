<product>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="card bg-white rounded-lg shadow-lg overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ $product->image }}" alt="Product Image">
                    <div class="card-content p-4">
                        <div class="card-title text-xl font-semibold text-gray-800 mb-2">{{ $product->title }}</div>
                        <div class="card-description text-gray-600 mb-4">{{ $product->description }}</div>
                        <a href="{{ route('checkout.index', ['id' => $product->id]) }}" class="purchase-button bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">View Item</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</product>

