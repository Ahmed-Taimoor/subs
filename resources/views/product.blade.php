<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <!-- Styles -->
    </head>
<body>
    <div>
        <h1>CRON JOBS LARAVEL</h1>
        <p>Purchse to continue</p>
    </div>
    <div class="card-container">
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
</body>
</html>
