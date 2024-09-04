@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <style>
        /* Scoped styles for the product detail page */
        .product-container {
            max-width: 1200px; /* Expanded width for a full-page look */
            margin: 60px auto; /* Margin to provide space below fixed navbar */
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .product-container h1 {
            color: #333;
            font-size: 3em; /* Larger title */
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .product-container h2 {
            color: #28a745;
            font-size: 2.5em; /* Larger price */
            margin-top: 10px;
            text-align: center;
        }

        .product-container p {
            font-size: 1.2em; /* Larger description text */
            color: #555;
            line-height: 1.6;
            margin-top: 20px;
        }

        .product-container .img-fluid {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%; /* Full width for better visual impact */
        }

        .product-container .form-group {
            margin-top: 20px;
        }

        .product-container .btn-primary {
            background: #007bff;
            border-color: #007bff;
            padding: 12px 24px;
            font-size: 1.2em;
            color: #fff;
            border-radius: 6px;
            text-align: center;
            transition: background 0.3s, transform 0.3s;
            display: block;
            width: 100%;
            margin-top: 20px; /* Space between button and form elements */
        }

        .product-container .btn-primary:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .product-container .alert-success {
            background: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
            text-align: center;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .col-md-6 {
            padding: 15px;
        }

        .col-md-6 img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
        }

        @media (max-width: 768px) {
            .product-container h1 {
                font-size: 2em; /* Adjusted font size for smaller screens */
            }

            .product-container h2 {
                font-size: 1.8em; /* Adjusted font size for smaller screens */
            }

            .product-container p {
                font-size: 1em; /* Adjusted font size for smaller screens */
            }
        }
    </style>

    <div class="product-container">
        <h1>{{ $product->name }}</h1>

        <div class="row">
            <div class="col-md-6">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2>${{ $product->price }}</h2>
                <p>{{ $product->description }}</p>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
