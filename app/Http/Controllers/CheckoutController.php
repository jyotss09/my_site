<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class CheckoutController extends Controller
{
    // Show the checkout form
    // public function showCheckoutForm()
    // {
    //     $cart = session()->get('cart', []);
    //     return view('checkout.form', compact('cart'));
    // }

    public function showCheckoutForm()
    {
        $cart = session()->get('cart', []);
        $addresses = Address::all(); // Fetch all addresses (or use another method if filtering is needed)
        return view('checkout.form', compact('cart', 'addresses'));
    }

    // Process the order
    public function processOrder(Request $request)
    {
        $request->validate([
            'billing_address_id' => 'required',
            'shipping_address_id' => 'required',
            'payment_method' => 'required|string',
            'new_billing_street_address' => 'nullable|string|max:255',
            'new_billing_city' => 'nullable|string|max:255',
            'new_billing_state' => 'nullable|string|max:255',
            'new_billing_pincode' => 'nullable|string|max:20',
            'new_billing_country' => 'nullable|string|max:255',
            'new_shipping_street_address' => 'nullable|string|max:255',
            'new_shipping_city' => 'nullable|string|max:255',
            'new_shipping_state' => 'nullable|string|max:255',
            'new_shipping_pincode' => 'nullable|string|max:20',
            'new_shipping_country' => 'nullable|string|max:255',
        ]);

        // Handle new billing address
        if ($request->input('billing_address_id') === 'new') {
            $billingAddress = Address::create([
                'user_id' => $request->user()->id,
                'street_address' => $request->input('new_billing_street_address'),
                'city' => $request->input('new_billing_city'),
                'state' => $request->input('new_billing_state'),
                'pincode' => $request->input('new_billing_pincode'),
                'country' => $request->input('new_billing_country'),
            ]);
            $billingAddressId = $billingAddress->id;
        } else {
            $billingAddressId = $request->input('billing_address_id');
            $billingAddress = Address::findOrFail($billingAddressId);  // Retrieve the existing billing address
        }

        // Handle new shipping address
        if ($request->input('shipping_address_id') === 'new') {
            $shippingAddress = Address::create([
                'user_id' => $request->user()->id,
                'street_address' => $request->input('new_shipping_street_address'),
                'city' => $request->input('new_shipping_city'),
                'state' => $request->input('new_shipping_state'),
                'pincode' => $request->input('new_shipping_pincode'),
                'country' => $request->input('new_shipping_country'),
            ]);
            $shippingAddressId = $shippingAddress->id;
        } else {
            $shippingAddressId = $request->input('shipping_address_id');
            $shippingAddress = Address::findOrFail($shippingAddressId);  // Retrieve the existing shipping address
        }

        // Retrieve cart data
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Create order
        $order = Order::create([
            'billing_address_id' => $billingAddressId,
            'shipping_address_id' => $shippingAddressId,
            'total_amount' => $total,
            'status' => 'pending', // Example status
        ]);

        // Clear the cart
        session()->forget('cart');

        // Retrieve the user associated with the billing address
        $user = $billingAddress->user;

        // Send order confirmation email
        try {
            Mail::to($user->email)->send(new OrderConfirmationMail($order));
        } catch (\Exception $e) {
            // Handle the error
            \Log::error('Order confirmation email could not be sent.', [
                'order_id' => $order->id,
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
        }

        // Redirect to success page
        return view('checkout.success', ['order' => $order]);
    }
}