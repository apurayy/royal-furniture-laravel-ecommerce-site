@extends('frontend.layout.main')

@section('title', 'My Addresses - Royal Furniture')

@section('styles')
<style>
    .accounts-page {
        padding: 40px 0;
    }

    .account-grid {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 40px;
    }

    .account-sidebar, .account-content {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .account-user {
        text-align: center;
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--border);
    }

    .account-avatar {
        width: 80px;
        height: 80px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }

    .account-avatar i {
        font-size: 32px;
        color: var(--secondary);
    }

    .account-user h4 {
        color: var(--primary);
        margin-bottom: 5px;
    }

    .account-user p {
        color: var(--text-light);
        font-size: 13px;
    }

    .account-menu {
        list-style: none;
    }

    .account-menu li {
        margin-bottom: 5px;
    }

    .account-menu a {
        display: block;
        padding: 12px 15px;
        color: var(--text-dark);
        border-radius: 5px;
        transition: all 0.3s;
    }

    .account-menu a:hover, .account-menu a.active {
        background: var(--bg-light);
        color: var(--secondary);
    }

    .account-menu a i {
        margin-right: 10px;
        width: 20px;
    }

    .address-form .form-group {
        margin-bottom: 15px;
    }

    .address-form textarea {
        min-height: 120px;
    }

</style>
@endsection

@section('content')
<div class="account-page">
    <div class="container">
        <h1 style="font-family: 'Cinzel', serif; font-size: 36px; color: var(--primary); margin-bottom: 40px;">My Addresses</h1>

        <div class="account-grid">
            <aside class="account-sidebar">
                <div class="account-user">
                    <div class="account-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h4>{{ auth()->user()->name }}</h4>
                    <p>{{ auth()->user()->email }}</p>
                </div>

                <ul class="account-menu">
                    <li><a href="{{ route('my-account') }}"><i class="fas fa-user"></i> My Profile</a></li>
                    <li><a href="{{ route('my-orders') }}"><i class="fas fa-box"></i> My Orders</a></li>
                    <li><a href="{{ route('my-addresses') }}" class="active"><i class="fas fa-map-marker-alt"></i> Addresses</a></li>
                    <li><a href="{{ route('wishlist') }}"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </aside>

            <div class="account-content">
                <h2>Manage your address</h2>

                @if(session('success'))
                    <div class="alert alert-success" style="margin-bottom: 15px;">{{ session('success') }}</div>
                @endif

                <form action="{{ route('my-addresses.update') }}" method="POST" class="address-form">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="address">Billing/Shipping Address</label>
                        <textarea name="address" id="address" class="form-control">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Save Address</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
