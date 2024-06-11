<product>
    <div class="card-container mx-auto">
    @foreach ($products as $product)
        <div class="card">
            <img src="{{$product->image}}" alt="Product Image">
            <div class="card-content">
                <div class="card-title">{{ $product->title }}</div>
                <div class="card-description">{{ $product->description }}</div>
                <a href = "{{route('checkout.index', ['id' => $product->id])}}" class="purchase-button">Purchase</a>
            </div>
        </div>
    @endforeach
    </div>
</product>
