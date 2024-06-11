
<x-app-layout>


<div class="checkout-container">
    <div class="product-details">
    <h1>Six Months Membership</h1>
        <h2>Product Details</h2>
        <div class="product-card">
            <img src="{{$product->image}}" alt="Product Image">
            <div class="product-info">
                <h3>{{$product->title}}</h3>
                <p>{{$product->description}}</p>
                <p><strong>Price:</strong> ${{$product->price}}</p>
            </div>
        </div>
    </div>
    <div class="checkout-form-container">
        <h2>Checkout</h2>
        <form class="checkout-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" required>
            </div>
            <div class="form-group">
                <label for="zip">Zip Code</label>
                <input type="text" id="zip" name="zip" required>
            </div>
            <div class="form-group">
                <label for="card">Credit Card Number</label>
                <input type="text" id="card" name="card" required>
            </div>
            <div class="form-group">
                <label for="exp">Expiration Date</label>
                <input type="text" id="exp" name="exp" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <button type="submit" class="purchase-button">Complete Purchase</button>
        </form>
    </div>
</div>
</x-app-layout>