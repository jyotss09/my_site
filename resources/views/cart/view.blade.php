@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>
    @endif

    @if(count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
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
                        <td>{{ $item['name'] }}</td>
                        <td>${{ $item['price'] }}</td>
                        <td>
                            <input type="number" name="quantity" class="quantity" value="{{ $item['quantity'] }}" min="1" data-price="{{ $item['price'] }}" required>
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
                    <td colspan="3" class="text-right"><strong>Total Amount:</strong></td>
                    <td id="cart-total">${{ $totalAmount }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <a href="{{ route('checkout.form') }}" class="btn btn-success">Proceed to Checkout</a>
    @else
        <p>Your cart is empty.</p>
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
    });

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