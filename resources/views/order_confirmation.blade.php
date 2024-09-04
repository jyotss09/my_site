<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <p>Your order number is {{ $order->id }}.</p>
    <p>Total amount: ${{ $order->total_amount }}</p>
    
    <h2>Billing Address</h2>
    <p>{{ $order->billingAddress->street_address }}, {{ $order->billingAddress->city }}, {{ $order->billingAddress->state }}, {{ $order->billingAddress->pincode }}, {{ $order->billingAddress->country }}</p>
    
    <h2>Shipping Address</h2>
    <p>{{ $order->shippingAddress->street_address }}, {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}, {{ $order->shippingAddress->pincode }}, {{ $order->shippingAddress->country }}</p>
</body>
</html>