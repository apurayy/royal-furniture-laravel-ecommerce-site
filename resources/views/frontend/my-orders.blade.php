@extends('frontend.layout.main')

@section('title', 'My Orders - Royal Furniture')

@section('styles')
<style>
    .orders-page {
        padding: 40px 0;
    }

    .orders-grid {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 40px;
    }

    .orders-sidebar {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        height: fit-content;
    }

    .orders-user {
        text-align: center;
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--border);
    }

    .orders-avatar {
        width: 80px;
        height: 80px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }

    .orders-avatar i {
        font-size: 32px;
        color: var(--secondary);
    }

    .orders-user h4 {
        color: var(--primary);
        margin-bottom: 5px;
    }

    .orders-user p {
        color: var(--text-light);
        font-size: 13px;
    }

    .orders-menu {
        list-style: none;
    }

    .orders-menu li {
        margin-bottom: 5px;
    }

    .orders-menu a {
        display: block;
        padding: 12px 15px;
        color: var(--text-dark);
        border-radius: 5px;
        transition: all 0.3s;
    }

    .orders-menu a:hover, .orders-menu a.active {
        background: var(--bg-light);
        color: var(--secondary);
    }

    .orders-menu a i {
        margin-right: 10px;
        width: 20px;
    }

    .orders-content {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .orders-content h2 {
        font-family: 'Cinzel', serif;
        font-size: 24px;
        color: var(--primary);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--secondary);
    }

    .orders-filters {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 8px 16px;
        border: 2px solid var(--border);
        border-radius: 20px;
        background: var(--white);
        color: var(--text-dark);
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .filter-btn:hover, .filter-btn.active {
        border-color: var(--secondary);
        background: var(--secondary);
        color: var(--primary);
    }

    .order-card {
        border: 1px solid var(--border);
        border-radius: 5px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .order-header {
        background: var(--bg-light);
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .order-info {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }

    .order-info-item {
        font-size: 14px;
    }

    .order-info-item span {
        color: var(--text-light);
        margin-right: 5px;
    }

    .order-info-item strong {
        color: var(--primary);
    }

    .order-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-processing {
        background: #fff3cd;
        color: #856404;
    }

    .status-shipped {
        background: #cce5ff;
        color: #004085;
    }

    .status-delivered {
        background: #d4edda;
        color: #155724;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .order-body {
        padding: 20px;
    }

    .order-products {
        margin-bottom: 20px;
    }

    .order-product {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid var(--border);
    }

    .order-product:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .order-product img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }

    .order-product-info h4 {
        font-size: 14px;
        color: var(--primary);
        margin-bottom: 5px;
    }

    .order-product-info p {
        font-size: 13px;
        color: var(--text-light);
    }

    .order-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .order-total {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary);
    }

    .order-actions a {
        padding: 8px 16px;
        border: 2px solid var(--secondary);
        border-radius: 5px;
        color: var(--secondary);
        font-size: 13px;
        font-weight: 600;
        margin-left: 10px;
        transition: all 0.3s;
    }

    .order-actions a:hover {
        background: var(--secondary);
        color: var(--primary);
    }

    .empty-orders {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-orders i {
        font-size: 60px;
        color: var(--border);
        margin-bottom: 20px;
    }

    .empty-orders h3 {
        font-family: 'Cinzel', serif;
        color: var(--primary);
        margin-bottom: 10px;
    }

    .empty-orders p {
        color: var(--text-light);
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .orders-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="orders-page">
    <div class="container">
        <h1 style="font-family: 'Cinzel', serif; font-size: 36px; color: var(--primary); margin-bottom: 40px;">My Orders</h1>

        <div class="orders-grid">
            <aside class="orders-sidebar">
                <div class="orders-user">
                    <div class="orders-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h4>{{ auth()->user()->name }}</h4>
                    <p>{{ auth()->user()->email }}</p>
                </div>

                <ul class="orders-menu">
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

            <div class="orders-content">
                <h2>Order History</h2>

                <div class="orders-filters">
                    <button class="filter-btn active">All Orders</button>
                    <button class="filter-btn">Processing</button>
                    <button class="filter-btn">Shipped</button>
                    <button class="filter-btn">Delivered</button>
                </div>

                @forelse($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-info">
                            <div class="order-info-item">
                                <span>Order Number:</span>
                                <strong>{{ $order->order_number }}</strong>
                            </div>
                            <div class="order-info-item">
                                <span>Date:</span>
                                <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                            </div>
                            <div class="order-info-item">
                                <span>Items:</span>
                                <strong>{{ $order->items->count() }}</strong>
                            </div>
                        </div>
                        <span class="order-status status-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="order-body">
                        <div class="order-products">
                            @foreach($order->items as $item)
                            <div class="order-product">
                                @php
                                    $productImage = null;
                                    if ($item->product && $item->product->first_image) {
                                        $productImage = asset('uploads/' . $item->product->first_image);
                                    } elseif ($item->product && $item->product->getFirstImageAttribute()) {
                                        $productImage = asset('uploads/' . $item->product->getFirstImageAttribute());
                                    }
                                @endphp
                                @if($productImage)
                                <img src="{{ $productImage }}" alt="{{ $item->product->name ?? $item->name }}">
                                @else
                                <img src="https://via.placeholder.com/60x60/1A1A2E/C9A227?text=No+Image" alt="{{ $item->product->name ?? $item->name }}">
                                @endif
                                <div class="order-product-info">
                                    <h4>{{ $item->name }}</h4>
                                    <p>Qty: {{ $item->quantity }} - {{ currency_format($item->product_price ?? $item->price) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="order-footer">
                            <span class="order-total">Total: {{ currency_format($order->total) }}</span>
                            <div class="order-actions">
                                <a href="{{ route('order-detail', $order) }}">View Details</a>
                                @if($order->status == 'delivered')
                                <a href="#">Buy Again</a>
                                @else
                                <a href="#">Track Order</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="no-orders">
                    <p>You haven't placed any orders yet.</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary">Start Shopping</a>
                </div>
                @endforelse

                {!! $orders->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
