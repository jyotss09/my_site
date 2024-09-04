@extends('layouts.app')

@section('title', 'Order Confirmed')

@section('content')
<div class="container">
    <h1>Order Confirmed!</h1>

    <p>Thank you for your purchase. Your order has been successfully processed.</p>

    <h3>Order Details</h3>
    <ul>
        <li><strong>Order ID:</strong> {{ $order->id }}</li>
        <li><strong>Total Amount:</strong> ${{ $order->total_amount }}</li>
        <li><strong>Status:</strong> {{ $order->status }}</li>
    </ul>

    <h3>Billing Address</h3>
    <p>{{ $order->billingAddress->street_address }}, {{ $order->billingAddress->city }}, {{ $order->billingAddress->state }}, {{ $order->billingAddress->pincode }}, {{ $order->billingAddress->country }}</p>

    <h3>Shipping Address</h3>
    <p>{{ $order->shippingAddress->street_address }}, {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}, {{ $order->shippingAddress->pincode }}, {{ $order->shippingAddress->country }}</p>

    <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
</div>
@endsection