@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container">
    <h1>Add New Product</h1>

    <form id="product_form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="image_url">Image URL</label>
            <input type="text" name="image_url" id="image_url" class="form-control">
        </div>
        <button type="submit" id="save_product" class="btn btn-primary mt-3">Save Product</button>
    </form>
</div>
@endsection

@vite('resources/js/productForm.js')
