@extends('frontend.layout.main')

@section('title', 'Order Confirmed - Royal Furniture')

@section('styles')
<style>
    .order-success {
        text-align: center;
    }

    .success-icon {
        width: 120px;
        height: 120px;
        background: var(--secondary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
    }

    .success-icon i {
        font-size: 60px;
        color: var(--primary);
    }

    .order-success h1 {
        font-family: 'Cinzel', serif;
        font-size: 36px;
        color: var(--primary);
        margin-bottom: 15px;
    }

    .order-success > p {
        color: var(--text-light);
        font-size: 18px;
        margin-bottom: 10px;
    }

    .order-number {
        font-size: 16px;
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 40px;
    }

    .order-details-box {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        max-width: 600px;
        margin: 0 auto 40px;
        text-align: left;
    }

    .order-details-box h3 {
        font-family: 'Cinzel', serif;
        font-size: 20px;
        color: var(--primary);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--secondary);
    }

    .order-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .order-info-item {
        margin-bottom: 15px;
    }

    .order-info-item label {
        display: block;
        font-size: 12px;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .order-info-item p {
        font-weight: 600;
        color: var(--primary);
    }

    .order-summary {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }

    .order-summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .order-summary-row.total {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .success-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .success-actions .btn {
        min-width: 200px;
    }
</style>
@endsection

@section('content')
<div class="section">
    <div class="container">
        <div class="order-success">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>

            <h1>Thank You!</h1>
            <p>Your order has been placed successfully.</p>
            <p class="order-number">Order Number: {{ $order->order_number }}</p>

            <div class="order-details-box">
                <h3>Order Details</h3>
                <div class="order-info-grid">
                    <div>
                        <div class="order-info-item">
                            <label>Order Date</label>
                            <p>{{ $order->created_at->format('F j, Y') }}</p>
                        </div>
                        <div class="order-info-item">
                            <label>Payment Method</label>
                            <p>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="order-info-item">
                            <label>Shipping Address</label>
                            <p>
                                {{ $shipping['name'] ?? 'N/A' }}<br>
                                {{ $shipping['address'] ?? '' }}<br>
                                {{ $shipping['city'] ?? '' }}{{ isset($shipping['city']) ? ',' : '' }} {{ $shipping['state'] ?? '' }} {{ $shipping['zip'] ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="order-summary">
                    @foreach($order->items as $item)
                        <div class="order-summary-row">
                            <span>{{ $item->product_name }} x {{ $item->quantity }}</span>
                            <span>{{ currency_format($item->product_price * $item->quantity) }}</span>
                        </div>
                    @endforeach
                    <div class="order-summary-row">
                        <span>Subtotal</span>
                        <span>{{ currency_format($order->subtotal) }}</span>
                    </div>
                    <div class="order-summary-row">
                        <span>Shipping</span>
                        <span>{{ currency_format($order->shipping_cost) }}</span>
                    </div>
                    <div class="order-summary-row">
                        <span>Tax</span>
                        <span>{{ currency_format($order->tax) }}</span>
                    </div>
                    <div class="order-summary-row total">
                        <span>Total</span>
                        <span>{{ currency_format($order->total) }}</span>
                    </div>
            </div>

            <div class="success-actions">
                <a href="{{ route('my-orders') }}" class="btn btn-primary">View My Orders</a>
                <a href="{{ route('shop') }}" class="btn btn-outline" style="border-color: var(--primary); color: var(--primary);">Continue Shopping</a>
            </div>

            <p style="margin-top: 40px; color: var(--text-light); font-size: 14px;">
                A confirmation email has been sent to your email address.<br>
                If you have any questions, please contact us at <a href="mailto:info@royalfurniture.com" style="color: var(--secondary);">info@royalfurniture.com</a>
            </p>
        </div>
    </div>
</div>
@endsection
