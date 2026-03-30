@extends('frontend.layout.main')

@section('title', 'Checkout - Royal Furniture')

@section('styles')
<style>
    .checkout-page {
        padding: 40px 0;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 40px;
    }

    .checkout-form {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .checkout-section {
        margin-bottom: 30px;
    }

    .checkout-section h3 {
        font-family: 'Cinzel', serif;
        font-size: 20px;
        color: var(--primary);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--secondary);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--border);
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--secondary);
    }

    select.form-control {
        background: var(--white);
        cursor: pointer;
    }

    .checkout-summary {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        height: fit-content;
        position: sticky;
        top: 100px;
    }

    .checkout-summary h3 {
        font-family: 'Cinzel', serif;
        font-size: 20px;
        color: var(--primary);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--secondary);
    }

    .summary-product {
        display: flex;
        gap: 15px;
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid var(--border);
    }

    .summary-product img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }

    .summary-product-info h4 {
        font-size: 14px;
        color: var(--primary);
        margin-bottom: 5px;
    }

    .summary-product-info p {
        font-size: 13px;
        color: var(--text-light);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
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

    .payment-methods {
        margin-top: 20px;
    }

    .payment-option {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px;
        border: 2px solid var(--border);
        border-radius: 5px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .payment-option:hover, .payment-option.selected {
        border-color: var(--secondary);
        background: var(--bg-light);
    }

    .payment-option input {
        margin: 0;
    }

    .payment-option label {
        flex: 1;
        cursor: pointer;
        font-weight: 500;
    }

    .payment-option i {
        font-size: 24px;
        color: var(--primary);
    }

    .terms-checkbox {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin: 20px 0;
    }

    .terms-checkbox input {
        margin-top: 3px;
    }

    .terms-checkbox label {
        font-size: 14px;
        color: var(--text-light);
    }

    .terms-checkbox a {
        color: var(--secondary);
    }

    .checkout-summary .btn {
        width: 100%;
    }

    @media (max-width: 1024px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="checkout-page">
    <div class="container">
        <h1 style="font-family: 'Cinzel', serif; font-size: 36px; color: var(--primary); margin-bottom: 40px;">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="checkout-grid">
                <div class="checkout-form">
                    <!-- Billing Details -->
                    <div class="checkout-section">
                        <h3>Billing Details</h3>
                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone *</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Address *</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">City *</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                    </div>

                    <!-- Shipping Details -->
                    <div class="checkout-section">
                        <h3>Shipping Details</h3>
                        <div class="form-group">
                            <div class="terms-checkbox">
                                <input type="checkbox" id="same_address" name="same_address">
                                <label for="same_address">Shipping address same as billing</label>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="checkout-section">
                        <h3>Payment Method</h3>
                        <div class="payment-methods">
                            <div class="payment-option selected">
                                <input type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label for="cod">
                                    <strong>Cash on Delivery</strong>
                                    <span style="display: block; font-size: 12px; color: var(--text-light); font-weight: 400;">Pay when you receive the order</span>
                                </label>
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="bank_transfer" value="bank_transfer">
                                <label for="bank_transfer">
                                    <strong>Bank Transfer</strong>
                                    <span style="display: block; font-size: 12px; color: var(--text-light); font-weight: 400;">Direct bank transfer</span>
                                </label>
                                <i class="fas fa-university"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="checkout-summary">
                    <h3>Your Order</h3>

                    @foreach($cart as $id => $item)
                    <div class="summary-product">
                        @if($item['image'])
                        <img src="{{ asset('uploads/' . $item['image']) }}" alt="{{ $item['name'] }}">
                        @else
                        <img src="https://via.placeholder.com/60x60/1A1A2E/C9A227?text=No+Image" alt="{{ $item['name'] }}">
                        @endif
                        <div class="summary-product-info">
                            <h4>{{ $item['name'] }}</h4>
                            <p>Qty: {{ $item['quantity'] }}</p>
                        </div>
                        <span style="margin-left: auto; font-weight: 600;">{{ currency_format($item['price'] * $item['quantity']) }}</span>
                    </div>
                    @endforeach

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>{{ currency_format($subtotal) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>{{ $shippingCost > 0 ? currency_format($shippingCost) : 'Free' }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax</span>
                        <span>{{ currency_format($tax) }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>{{ currency_format($total) }}</span>
                    </div>

                    <div class="terms-checkbox">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I agree to the <a href="{{ route('page', 'terms-conditions') }}">Terms & Conditions</a> and <a href="{{ route('page', 'privacy-policy') }}">Privacy Policy</a></label>
                    </div>

                    <button type="submit" class="btn btn-primary">Place Order</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
