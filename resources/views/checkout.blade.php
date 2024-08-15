
<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Six Months Membership</h1>

        <h2 class="text-xl font-medium text-gray-700 mb-4">Product Details</h2>

        <div class="product-card flex items-start bg-gray-100 p-4 rounded-lg shadow-md">
            <img class="w-48 h-48 object-cover rounded-lg" src="{{$product->image}}" alt="Product Image">

            <div class="product-info ml-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{$product->title}}</h3>
                <p class="text-gray-600 mb-4">{{$product->description}}</p>
                <p class="text-gray-800 text-lg font-semibold mb-4"><strong>Price:</strong> ${{$product->price}}</p>

                <!-- Purchase Button -->
                <form action="{{ route('checkout.store') }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                        Purchase
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

