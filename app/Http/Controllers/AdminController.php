<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;


class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }

    // Show the products management page
    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

       public function createProduct()
    {
        return view('admin.create_product');
    }

    // Store a newly created product
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string'
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    // Show the form for editing a product
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    // Update the specified product
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    // Show the orders management page
    public function orders()
    {
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }
    

}
