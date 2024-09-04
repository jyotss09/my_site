@extends('layouts.app')

@section('content')
<style>
    .custom-col {
        flex: 0 0 20%; /* 20% width for each column to fit 5 columns in a row */
        max-width: 20%; /* Ensure columns do not exceed 20% of row width */
    }

    .row {
        display: flex; /* Use Flexbox for custom column widths */
        flex-wrap: wrap; /* Allow columns to wrap to the next row */
    }
</style>

<div class="container">
    <div class="container mt-4">
            <div class="row">
                @foreach($products as $product)
                    <div class="custom-col mb-4">
                        <div class="card">
                            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">${{ $product->price }}</p>
                                <a href="{{ url('/product/' . $product->id) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</div>
@endsection
