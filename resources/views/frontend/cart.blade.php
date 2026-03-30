@extends('frontend.layout.main')

@section('title', 'Shopping Cart - Royal Furniture')

@section('styles')
<style>
    .cart-page {
        padding: 40px 0;
    }

    .cart-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 40px;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        background: var(--white);
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .cart-table th {
        background: var(--primary);
        color: var(--white);
        padding: 18px 20px;
        text-align: left;
        font-weight: 600;
    }

    .cart-table td {
        padding: 20px;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }

    .cart-product {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .cart-product img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }

    .cart-product-info h4 {
        font-size: 16px;
        color: var(--primary);
        margin-bottom: 5px;
    }

    .cart-product-info p {
        font-size: 13px;
        color: var(--text-light);
    }

    .quantity-input {
        display: inline-flex;
        align-items: center;
        border: 2px solid var(--border);
        border-radius: 5px;
        overflow: hidden;
    }

    .quantity-input button {
        padding: 8px 12px;
        border: none;
        background: var(--bg-light);
        cursor: pointer;
    }

    .quantity-input input {
        width: 50px;
        text-align: center;
        border: none;
        padding: 8px;
    }

    .remove-btn {
        color: #dc3545;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    .remove-btn:hover {
        color: #c82333;
    }

    .cart-summary {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        height: fit-content;
        position: sticky;
        top: 100px;
    }

    .cart-summary h3 {
        font-family: 'Cinzel', serif;
        font-size: 20px;
        color: var(--primary);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--secondary);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 15px;
    }

    .summary-row.total {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        padding-top: 15px;
        border-top: 1px solid var(--border);
        margin-top: 15px;
    }

    .cart-summary .btn {
        width: 100%;
        margin-top: 20px;
    }

    .coupon-form {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .coupon-form input {
        flex: 1;
        padding: 12px;
        border: 2px solid var(--border);
        border-radius: 5px;
    }

    .continue-shopping {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: var(--text-light);
        font-size: 14px;
    }

    .continue-shopping:hover {
        color: var(--secondary);
    }

    .empty-cart {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-cart i {
        font-size: 80px;
        color: var(--border);
        margin-bottom: 20px;
    }

    .empty-cart h3 {
        font-family: 'Cinzel', serif;
        color: var(--primary);
        margin-bottom: 15px;
    }

    .empty-cart p {
        color: var(--text-light);
        margin-bottom: 25px;
    }

    @media (max-width: 1024px) {
        .cart-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="cart-page">
    <div class="container">
        <h1 style="font-family: 'Cinzel', serif; font-size: 36px; color: var(--primary); margin-bottom: 40px;">Shopping Cart</h1>

        <div class="cart-grid">
            <div class="cart-items">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cart as $id => $item)
                        <tr>
                            <td>
                                <div class="cart-product">
                                    @if($item['image'])
                                    <img src="{{ asset('uploads/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                    @else
                                    <img src="https://via.placeholder.com/80x80/1A1A2E/C9A227?text=No+Image" alt="{{ $item['name'] }}">
                                    @endif
                                    <div class="cart-product-info">
                                        <h4>{{ $item['name'] }}</h4>
                                        <p>SKU: {{ $id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ currency_format($item['price']) }}</td>
                            <td>
                                <div class="quantity-input">
                                    <button onclick="updateCart({{ $id }}, {{ $item['quantity'] - 1 }})" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                                    <input type="number" value="{{ $item['quantity'] }}" min="1" onchange="updateCart({{ $id }}, this.value)">
                                    <button onclick="updateCart({{ $id }}, {{ $item['quantity'] + 1 }})">+</button>
                                </div>
                            </td>
                            <td>{{ currency_format($item['price'] * $item['quantity']) }}</td>
                            <td>
                                <button class="remove-btn" onclick="removeFromCart({{ $id }})"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px;">Your cart is empty.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="cart-summary">
                <h3>Order Summary</h3>

                <div class="coupon-form">
                    <input type="text" placeholder="Coupon code">
                    <button class="btn btn-outline" style="border-color: var(--primary); color: var(--primary); padding: 12px 20px;">Apply</button>
                </div>

                @php
                    $subtotal = 0;
                    foreach($cart as $item) {
                        $subtotal += $item['price'] * $item['quantity'];
                    }
                    $shipping = 0; // Free shipping
                    $tax = 0; // No tax for now
                    $total = $subtotal + $shipping + $tax;
                @endphp

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>{{ currency_format($subtotal) }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>{{ $shipping > 0 ? currency_format($shipping) : 'Free' }}</span>
                </div>
                <div class="summary-row">
                    <span>Tax</span>
                    <span>{{ currency_format($tax) }}</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>{{ currency_format($total) }}</span>
                </div>

                @if(!empty($cart))
                <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
                @endif
                <a href="{{ route('shop') }}" class="continue-shopping">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>
@endsection
