@extends('frontend.layout.main')

@section('title', 'Order Details - Royal Furniture')

@section('styles')
<style>
    .order-detail-page {
        padding: 40px 0;
    }

    .order-detail-grid {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 40px;
    }

    .order-detail-sidebar {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        height: fit-content;
    }

    .order-detail-user {
        text-align: center;
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--border);
    }

    .order-detail-avatar {
        width: 80px;
        height: 80px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }

    .order-detail-avatar i {
        font-size: 32px;
        color: var(--secondary);
    }

    .order-detail-user h4 {
        color: var(--primary);
        margin-bottom: 5px;
    }

    .order-detail-user p {
        color: var(--text-light);
        font-size: 13px;
    }

    .order-detail-menu {
        list-style: none;
    }

    .order-detail-menu li {
        margin-bottom: 5px;
    }

    .order-detail-menu a {
        display: block;
        padding: 12px 15px;
        color: var(--text-dark);
        border-radius: 5px;
        transition: all 0.3s;
    }

    .order-detail-menu a:hover, .order-detail-menu a.active {
        background: var(--bg-light);
        color: var(--secondary);
    }

    .order-detail-menu a i {
        margin-right: 10px;
        width: 20px;
    }

    .order-detail-content {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border);
    }

    .order-title h2 {
        color: var(--primary);
        margin: 0;
    }

    .order-status {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cce5ff; color: #004085; }
    .status-shipped { background: #d1ecf1; color: #0c5460; }
    .status-delivered { background: #d4edda; color: #155724; }
    .status-cancelled { background: #f8d7da; color: #721c24; }

    .order-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-card {
        background: var(--bg-light);
        padding: 20px;
        border-radius: 5px;
    }

    .info-card h4 {
        color: var(--primary);
        margin-bottom: 10px;
        font-size: 16px;
    }

    .info-card p {
        margin: 5px 0;
        color: var(--text-dark);
    }

    .order-items {
        margin-bottom: 30px;
    }

    .order-items h3 {
        color: var(--primary);
        margin-bottom: 20px;
    }

    .order-item {
        display: flex;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid var(--border);
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 80px;
        height: 80px;
        border-radius: 5px;
        object-fit: cover;
        margin-right: 20px;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 500;
        color: var(--primary);
        margin-bottom: 5px;
    }

    .item-price {
        color: var(--text-light);
        font-size: 14px;
    }

    .item-quantity {
        color: var(--text-dark);
        margin-right: 20px;
    }

    .item-total {
        font-weight: 500;
        color: var(--primary);
    }

    .order-summary {
        background: var(--bg-light);
        padding: 20px;
        border-radius: 5px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .summary-row.total {
        border-top: 1px solid var(--border);
        padding-top: 10px;
        font-weight: 600;
        font-size: 18px;
        color: var(--primary);
    }

    @media (max-width: 768px) {
        .order-detail-grid {
            grid-template-columns: 1fr;
        }

        .order-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .order-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .item-image {
            margin-bottom: 15px;
        }
    }
</style>
@endsection

@section('content')
<div class="order-detail-page">
    <div class="container">
        <div class="order-detail-grid">
            <aside class="order-detail-sidebar">
                <div class="order-detail-user">
                    <div class="order-detail-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h4>{{ auth()->user()->name }}</h4>
                    <p>{{ auth()->user()->email }}</p>
                </div>

                <ul class="order-detail-menu">
                    <li><a href="{{ route('my-account') }}"><i class="fas fa-user"></i> My Profile</a></li>
                    <li><a href="{{ route('my-orders') }}" class="active"><i class="fas fa-box"></i> My Orders</a></li>
                    <li><a href="{{ route('my-addresses') }}"><i class="fas fa-map-marker-alt"></i> Addresses</a></li>
                    <li><a href="{{ route('wishlist') }}"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </aside>

            <div class="order-detail-content">
                <div class="order-header">
                    <div class="order-title">
                        <h2>Order #{{ $order->order_number }}</h2>
                        <p>Placed on {{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <span class="order-status status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="order-info">
                    <div class="info-card">
                        <h4>Shipping Address</h4>
                        <div>
                            @if($order->shipping_address)
                                @php
                                    $shipping = json_decode($order->shipping_address, true);
                                @endphp
                                @if(is_array($shipping))
                                    <p>{{ $shipping['name'] ?? '' }}</p>
                                    <p>{{ $shipping['address'] ?? '' }}</p>
                                    <p>{{ $shipping['city'] ?? '' }}, {{ $shipping['state'] ?? '' }} {{ $shipping['zip'] ?? '' }}</p>
                                    <p>{{ $shipping['country'] ?? '' }}</p>
                                @else
                                    <p>{{ $order->shipping_address }}</p>
                                @endif
                            @else
                                <p>No shipping address provided</p>
                            @endif
                        </div>
                    </div>

                    <div class="info-card">
                        <h4>Payment Information</h4>
                        <p><strong>Method:</strong> {{ ucfirst($order->payment_method ?? 'N/A') }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($order->payment_status ?? 'N/A') }}</p>
                    </div>
                </div>

                <div class="order-items">
                    <h3>Order Items</h3>
                    @foreach($order->items as $item)
                    <div class="order-item">
                        @php
                            $itemImage = null;
                            if ($item->product && $item->product->first_image) {
                                $itemImage = asset('uploads/' . $item->product->first_image);
                            } elseif ($item->product && $item->product->getFirstImageAttribute()) {
                                $itemImage = asset('uploads/' . $item->product->getFirstImageAttribute());
                            }
                        @endphp
                        @if($itemImage)
                            <img src="{{ $itemImage }}" alt="{{ $item->product->name ?? $item->product_name }}" class="item-image">
                        @else
                            <div class="item-image" style="background: var(--bg-light); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="color: var(--text-light);"></i>
                            </div>
                        @endif

                        <div class="item-details">
                            <div class="item-name">{{ $item->product->name ?? $item->product_name }}</div>
                            <div class="item-price">{{ currency_format($item->product_price) }}</div>
                        </div>

                        <div class="item-quantity">Qty: {{ $item->quantity }}</div>
                        <div class="item-total">{{ currency_format($item->product_price * $item->quantity) }}</div>
                    </div>
                    @endforeach
                </div>

                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>{{ currency_format($order->subtotal) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span>{{ currency_format($order->shipping_cost) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax:</span>
                        <span>{{ currency_format($order->tax) }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>{{ currency_format($order->total) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
