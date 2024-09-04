<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Total Amount: ${{ $order->total_amount }}</p>

    <h2>Billing Address</h2>
    <p>{{ $order->billingAddress->street_address }}</p>
    <p>{{ $order->billingAddress->city }}, {{ $order->billingAddress->state }} {{ $order->billingAddress->pincode }}</p>
    <p>{{ $order->billingAddress->country }}</p>

    <h2>Shipping Address</h2>
    <p>{{ $order->shippingAddress->street_address }}</p>
    <p>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->pincode }}</p>
    <p>{{ $order->shippingAddress->country }}</p>

    <p>We will notify you once your order is shipped.</p>
</body>
</html>