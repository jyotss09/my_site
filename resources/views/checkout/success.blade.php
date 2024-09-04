@extends('layouts.app')

@section('title', 'Order Confirmed')

@section('content')
    <style>
        /* Styling for the content area */
        .order-confirmation {
            max-width: 600px; /* Reduced max-width */
            margin: 45px auto; /* Adjusted margin-top for spacing below fixed navbar */
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden; /* Ensure no overflow happens */
        }

        .order-confirmation h1 {
            color: #28a745;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em; /* Adjusted font size */
            font-weight: bold;
        }

        .order-confirmation h3 {
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-top: 20px;
            font-size: 1.3em; /* Adjusted font size */
        }

        .order-confirmation p {
            font-size: 1em; /* Adjusted font size */
            line-height: 1.5;
            color: #555;
        }

        .order-confirmation ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .order-confirmation li {
            padding: 8px 0; /* Adjusted padding */
            border-bottom: 1px solid #eee;
            font-size: 1em; /* Adjusted font size */
            color: #333;
        }

        .btn-primary {
            display: inline-block;
            padding: 8px 16px; /* Adjusted padding */
            font-size: 1em; /* Adjusted font size */
            color: #fff;
            background: #007bff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            margin-top: 20px;
            transition: background 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
    </style>

    <div class="order-confirmation">
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

        <a href="{{ route('home') }}" class="btn-primary">Continue Shopping</a>
    </div>
@endsection
