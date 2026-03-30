@extends('admin.layout.wrapper')

@section('title', 'Orders')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Orders</h3>
    </div>

    <form action="{{ route('admin.orders.index') }}" method="GET" class="search-form">
        <input type="text" name="search" class="form-control" placeholder="Search by order number or customer..." value="{{ request('search') }}">
        <select name="status" class="form-control">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <select name="payment_status" class="form-control">
            <option value="">All Payment</option>
            <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ currency_format($order->total) }}</td>
                <td>
                    <span class="badge badge-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : ($order->status === 'shipped' ? 'info' : 'warning')) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-{{ $order->payment_status === 'paid' ? 'success' : ($order->payment_status === 'failed' ? 'danger' : 'warning') }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
                <td class="actions">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>
@endsection
