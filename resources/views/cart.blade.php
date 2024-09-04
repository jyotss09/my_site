<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('partials.header')
    <div class="container mt-4">
        <h1>Your Cart</h1>
        <!-- Display cart items here -->
        <form action="{{ url('/checkout') }}" method="POST">
            @csrf
            <h3>Billing Address</h3>
            <input type="text" name="billing_street_address" class="form-control mb-2" placeholder="Street Address" required>
            <input type="text" name="billing_city" class="form-control mb-2" placeholder="City" required>
            <input type="text" name="billing_state" class="form-control mb-2" placeholder="State">
            <input type="text" name="billing_pincode" class="form-control mb-2" placeholder="Pincode" required>
            <input type="text" name="billing_country" class="form-control mb-2" placeholder="Country" required>
            <input type="email" name="billing_email" class="form-control mb-2" placeholder="Email" required>

            <h3>Shipping Address</h3>
            <input type="text" name="shipping_street_address" class="form-control mb-2" placeholder="Street Address" required>
            <input type="text" name="shipping_city" class="form-control mb-2" placeholder="City" required>
            <input type="text" name="shipping_state" class="form-control mb-2" placeholder="State">
            <input type="text" name="shipping_pincode" class="form-control mb-2" placeholder="Pincode" required>
            <input type="text" name="shipping_country" class="form-control mb-2" placeholder="Country" required>

            <button type="submit" class="btn btn-primary">Confirm Purchase</button>
        </form>
    </div>
    @include('partials.footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>