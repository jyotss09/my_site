@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<style>
    /* Custom Styles */
    .card-header {
        font-weight: bold;
        font-size: 1.25rem;
    }
    
    .nav-pills .nav-link {
        border-radius: .25rem;
    }
    
    .nav-link.active {
        background-color: #007bff;
        color: #fff;
    }
    
    .form-control, .form-select {
        border-radius: .375rem;
    }
    
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    </style>
<div class="container">
    <h1 class="my-4 text-center">Checkout</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
        @csrf

        <!-- Tab Navigation -->
        <ul class="nav nav-pills mb-4" id="checkoutTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="billing-tab" data-bs-toggle="pill" href="#billing-info-step" role="tab" aria-controls="billing-info-step" aria-selected="true">Billing Address</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="shipping-tab" data-bs-toggle="pill" href="#shipping-info-step" role="tab" aria-controls="shipping-info-step" aria-selected="false">Shipping Address</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="payment-tab" data-bs-toggle="pill" href="#payment-info-step" role="tab" aria-controls="payment-info-step" aria-selected="false">Payment Information</a>
            </li>
        </ul>

        <!-- Tab Panes -->
        <div class="tab-content" id="checkoutTabsContent">
            <!-- Billing Information -->
            <div class="tab-pane fade show active" id="billing-info-step" role="tabpanel" aria-labelledby="billing-tab">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Billing Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="billing_address_id">Billing Address</label>
                            <select name="billing_address_id" id="billing_address_id" class="form-select" required>
                                @foreach($addresses as $address)
                                    <option value="{{ $address->id }}">{{ $address->street_address }}, {{ $address->city }}, {{ $address->state }}, {{ $address->pincode }}, {{ $address->country }}</option>
                                @endforeach
                                <option value="new">Add New Address</option>
                            </select>
                        </div><br>

                        <div id="new_billing_address" style="display: none;">
                            <h5>Add New Billing Address</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_billing_street_address">Street Address</label>
                                        <input type="text" name="new_billing_street_address" id="new_billing_street_address" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_billing_city">City</label>
                                        <input type="text" name="new_billing_city" id="new_billing_city" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_billing_state">State</label>
                                        <input type="text" name="new_billing_state" id="new_billing_state" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_billing_pincode">Pincode</label>
                                        <input type="text" name="new_billing_pincode" id="new_billing_pincode" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_billing_country">Country</label>
                                        <input type="text" name="new_billing_country" id="new_billing_country" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="tab-pane fade" id="shipping-info-step" role="tabpanel" aria-labelledby="shipping-tab">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Shipping Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="shipping_address_id">Shipping Address</label>
                            <select name="shipping_address_id" id="shipping_address_id" class="form-select" required>
                                @foreach($addresses as $address)
                                    <option value="{{ $address->id }}">{{ $address->street_address }}, {{ $address->city }}, {{ $address->state }}, {{ $address->pincode }}, {{ $address->country }}</option>
                                @endforeach
                                <option value="new">Add New Address</option>
                            </select>
                        </div><br>

                        <div id="new_shipping_address" style="display: none;">
                            <h5>Add New Shipping Address</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_shipping_street_address">Street Address</label>
                                        <input type="text" name="new_shipping_street_address" id="new_shipping_street_address" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_shipping_city">City</label>
                                        <input type="text" name="new_shipping_city" id="new_shipping_city" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_shipping_state">State</label>
                                        <input type="text" name="new_shipping_state" id="new_shipping_state" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_shipping_pincode">Pincode</label>
                                        <input type="text" name="new_shipping_pincode" id="new_shipping_pincode" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_shipping_country">Country</label>
                                        <input type="text" name="new_shipping_country" id="new_shipping_country" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="tab-pane fade" id="payment-info-step" role="tabpanel" aria-labelledby="payment-tab">
                <div class="card mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Payment Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="credit_card">Credit Card</option>
                                <option value="paypal">PayPal</option>
                                <!-- Add other payment methods as needed -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="form-navigation mt-3 text-center">
            <button type="submit" id="submit-btn" class="btn btn-primary btn-lg">Confirm Order</button>
        </div>
    </form>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const billingSelect = document.getElementById('billing_address_id');
    const shippingSelect = document.getElementById('shipping_address_id');
    const newBillingAddress = document.getElementById('new_billing_address');
    const newShippingAddress = document.getElementById('new_shipping_address');

    billingSelect.addEventListener('change', () => {
        newBillingAddress.style.display = billingSelect.value === 'new' ? 'block' : 'none';
    });

    shippingSelect.addEventListener('change', () => {
        newShippingAddress.style.display = shippingSelect.value === 'new' ? 'block' : 'none';
    });
});
</script>



@endsection