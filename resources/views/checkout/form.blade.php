@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <h3>Billing Information</h3>
        <div class="form-group">
            <label for="billing_address_id">Billing Address</label>
            <select name="billing_address_id" id="billing_address_id" class="form-control" required>
                <!-- Fetch and list addresses from the database -->
                @foreach($addresses as $address)
                    <option value="{{ $address->id }}">{{ $address->street_address }}, {{ $address->city }}, {{ $address->state }}, {{ $address->pincode }}, {{ $address->country }}</option>
                @endforeach
                <option value="new">Add New Address</option>
            </select>
        </div><br>

        <div id="new_billing_address" style="display: none;">
            <h3>Add New Billing Address</h3>
            <div class="form-group">
                <label for="new_billing_street_address">Street Address</label>
                <input type="text" name="new_billing_street_address" id="new_billing_street_address" class="form-control">
            </div>
            <div class="form-group">
                <label for="new_billing_city">City</label>
                <input type="text" name="new_billing_city" id="new_billing_city" class="form-control">
            </div>
            <div class="form-group">
                <label for="new_billing_state">State</label>
                <input type="text" name="new_billing_state" id="new_billing_state" class="form-control">
            </div>
            <div class="form-group">
                <label for="new_billing_pincode">Pincode</label>
                <input type="text" name="new_billing_pincode" id="new_billing_pincode" class="form-control">
            </div>
            <div class="form-group">
                <label for="new_billing_country">Country</label>
                <input type="text" name="new_billing_country" id="new_billing_country" class="form-control">
            </div>
        </div>

        <h3>Shipping Information</h3>
        <div class="form-group">
            <label for="shipping_address_id">Shipping Address</label>
            <select name="shipping_address_id" id="shipping_address_id" class="form-control" required>
                <!-- Fetch and list addresses from the database -->
                @foreach($addresses as $address)
                    <option value="{{ $address->id }}">{{ $address->street_address }}, {{ $address->city }}, {{ $address->state }}, {{ $address->pincode }}, {{ $address->country }}</option>
                @endforeach
                <option value="new">Add New Address</option>
            </select>
        </div><br>

        <div id="new_shipping_address" style="display: none;">
            <h3>Add New Shipping Address</h3>
            <div class="form-group">
                <label for="new_shipping_street_address">Street Address</label>
                <input type="text" name="new_shipping_street_address" id="new_shipping_street_address" class="form-control">
            </div>
            <div class="form-group">
                <label for="new_shipping_city">City</label>
                <input type="text" name="new_shipping_city" id="new_shipping_city" class="form-control">
            </div>
            <div class="form-group">
                <label for="new_shipping_state">State</label>
                <input type="text" name="new_shipping_state" id="new_shipping_state" class="form-control">
            </div>
            <div class="form-group">
                <label for="new_shipping_pincode">Pincode</label>
                <input type="text" name="new_shipping_pincode" id="new_shipping_pincode" class="form-control">
            </div>
            <div class="form-group">
                <label for="new_shipping_country">Country</label>
                <input type="text" name="new_shipping_country" id="new_shipping_country" class="form-control">
            </div>
        </div>

        <h3>Payment Information</h3>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <!-- Add other payment methods as needed -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Confirm Order</button>
    </form>
</div>

<script>
document.getElementById('billing_address_id').addEventListener('change', function() {
    var newAddressDiv = document.getElementById('new_billing_address');
    if (this.value === 'new') {
        newAddressDiv.style.display = 'block';
    } else {
        newAddressDiv.style.display = 'none';
    }
});

document.getElementById('shipping_address_id').addEventListener('change', function() {
    var newAddressDiv = document.getElementById('new_shipping_address');
    if (this.value === 'new') {
        newAddressDiv.style.display = 'block';
    } else {
        newAddressDiv.style.display = 'none';
    }
});
</script>
@endsection