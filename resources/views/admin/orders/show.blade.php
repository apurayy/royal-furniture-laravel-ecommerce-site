@extends('admin.layout.wrapper')

@section('title', 'Order Details')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Order #{{ $order->order_number }}</h3>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div>
            <h4 style="color: var(--primary); margin-bottom: 15px;">Customer Information</h4>
            <p><strong>Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Phone:</strong> {{ $order->shipping_phone ?? 'N/A' }}</p>
        </div>
        <div>
            <h4 style="color: var(--primary); margin-bottom: 15px;">Shipping Address</h4>
            <p>{{ $order->shipping_address }}</p>
            <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
            <p>{{ $order->shipping_country }}</p>
        </div>
    </div>

    <h4 style="color: var(--primary); margin: 20px 0 15px;">Order Items</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                        @endif
                        {{ $item->product->name }}
                    </div>
                </td>
                <td>{{ currency_format($item->product_price) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ currency_format($item->product_price * $item->quantity) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Subtotal:</strong></td>
                <td>{{ currency_format($order->subtotal) }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Shipping:</strong></td>
                <td>{{ currency_format($order->shipping_cost) }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Tax:</strong></td>
                <td>{{ currency_format($order->tax) }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                <td><strong>{{ currency_format($order->total) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border);">
        <h4 style="color: var(--primary); margin-bottom: 15px;">Update Order Status</h4>
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display: flex; gap: 15px; align-items: flex-end;">
                <div class="form-group" style="margin-bottom: 0; flex: 1;">
                    <label class="form-label">Order Status</label>
                    <select name="status" class="form-control">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0; flex: 1;">
                    <label class="form-label">Payment Status</label>
                    <select name="payment_status" class="form-control">
                        <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
