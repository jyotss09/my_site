@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
<div class="container">
    <h1>Manage Products</h1>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('admin.createProduct') }}" class="btn btn-primary mb-3">Add New Product</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ $product->price }}</td>
                    <td>
                        <a href="{{ route('admin.editProduct', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.deleteProduct', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
     document.addEventListener('DOMContentLoaded', function () {
        var alertElements = document.querySelectorAll('.alert-dismissible .btn-close');
        alertElements.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var alert = this.parentElement;
                alert.classList.remove('show');
                alert.classList.add('fade');
            });
        });
    });
</script>
@endsection