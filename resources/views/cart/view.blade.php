@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Shopping Cart</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalAmount = 0;
                    @endphp
                    @foreach($cart as $id => $item)
                        @php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $totalAmount += $itemTotal;
                        @endphp
                        <tr data-id="{{ $id }}">
                            <td>
                                <!-- Display product image -->
                                @if(!empty($item['image_url']))
                                    <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="img-fluid rounded" style="max-width: 80px;">
                                @else
                                    <img src="" alt="No image available" class="img-fluid rounded" style="max-width: 80px;">
                                @endif
                                
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>${{ $item['price'] }}</td>
                            <td>
                                <input type="number" name="quantity" class="form-control quantity" value="{{ $item['quantity'] }}" min="1" data-price="{{ $item['price'] }}" required>
                            </td>
                            <td class="item-total">${{ $itemTotal }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total Amount:</strong></td>
                        <td id="cart-total">${{ $totalAmount }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <a href="{{ route('checkout.form') }}" class="btn btn-success btn-lg mt-3">Proceed to Checkout</a>
        </div>
    @else
        <div class="alert alert-info" role="alert">
            Your cart is empty.
        </div>
    @endif
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        function updateTotal() {
            let totalAmount = 0;

            $('.quantity').each(function() {
                let quantity = $(this).val();
                let price = $(this).data('price');
                let itemTotal = quantity * price;

                $(this).closest('tr').find('.item-total').text('$' + itemTotal.toFixed(2));

                totalAmount += itemTotal;
            });

            $('#cart-total').text('$' + totalAmount.toFixed(2));
        }

        // Update total when quantity changes
        $('.quantity').on('input', function() {
            updateTotal();
        });

        // Initial update
        updateTotal();

        // Auto-dismiss success message after 5 seconds
        setTimeout(function() {
            $('.alert-success').fadeOut('slow');
        }, 1000);

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
    });
</script>

@endsection
