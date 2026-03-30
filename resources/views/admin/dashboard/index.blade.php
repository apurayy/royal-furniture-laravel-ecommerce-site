@extends('admin.layout.wrapper')

@section('title', 'Dashboard')

@section('main-content')
<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Sales</h3>
        <div class="value">{{ currency_format($totalSales) }}</div>
        <i class="fas fa-dollar-sign icon"></i>
    </div>
    <div class="stat-card">
        <h3>Total Orders</h3>
        <div class="value">{{ $totalOrders }}</div>
        <i class="fas fa-shopping-bag icon"></i>
    </div>
    <div class="stat-card">
        <h3>Total Products</h3>
        <div class="value">{{ $totalProducts }}</div>
        <i class="fas fa-box icon"></i>
    </div>
    <div class="stat-card">
        <h3>Total Customers</h3>
        <div class="value">{{ $totalCustomers }}</div>
        <i class="fas fa-users icon"></i>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Orders</h3>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentOrders as $order)
            <tr>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ currency_format($order->total) }}</td>
                <td>
                    <span class="badge badge-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Low Stock Products</h3>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>SKU</th>
                <th>Stock</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lowStockProducts as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>
                    <span class="badge badge-danger">{{ $product->stock_quantity }} left</span>
                </td>
                <td>{{ currency_format($product->price) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
