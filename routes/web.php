<?php

use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;

// Group admin routes under a prefix and optional middleware
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.createProduct');
    Route::post('/storeProduct', [AdminController::class, 'storeProduct'])->name('admin.storeProduct');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.editProduct');
    Route::put('/updateProduct/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateProduct');
    Route::delete('/deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteProduct');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
});


// Home page - displays list of products
Route::get('/', [ProductController::class, 'index'])->name('home');

// Product detail page - displays a single product's details
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Add to cart - handles adding a product to the cart
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// View cart - displays the contents of the cart
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');

// Checkout - displays the checkout form and processes the order
Route::post('/checkout', [CheckoutController::class, 'processOrder'])->name('checkout.process');
Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');

// Create a new address (POST request from JavaScript)
Route::post('/address', [AddressController::class, 'createAddress'])->name('address.create');
// Route::get('/order', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
Auth::routes();

Route::get('/test-email', function () {
    // Replace with a valid order ID or mock data
    $order = \App\Models\Order::find(1); 
    Mail::to('test@example.com')->send(new OrderConfirmationMail($order));
    return 'Email sent!';
});