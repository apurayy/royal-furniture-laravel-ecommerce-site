@extends('admin.layout.wrapper')

@section('title', 'User Details')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Details</h3>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Basic Information</h5>
                <p><strong>ID:</strong> {{ $user->id }}</p>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                <p><strong>Registered:</strong> {{ $user->created_at->format('M d, Y') }}</p>
            </div>
            <div class="col-md-6">
                <h5>Address</h5>
                <p>{{ $user->address ?? 'No address provided' }}</p>
            </div>
        </div>

        <h5 class="mt-4">Orders</h5>
        @if($user->orders->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order#</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ currency_format($order->total) }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No orders for this user.</p>
        @endif
    </div>
</div>
@endsection
