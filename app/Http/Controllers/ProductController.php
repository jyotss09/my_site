<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Show the home page with the list of products
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Return the view with the products data
        return view('home', ['products' => $products]);
    }

    // Show the details of a single product
    public function show($id)
    {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Return the view with the product data
        return view('product', ['product' => $product]);
    }
}