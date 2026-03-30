@extends('frontend.layout.main')

@section('title', 'My Account - Royal Furniture')

@section('styles')
<style>
    .account-page {
        padding: 40px 0;
    }

    .account-grid {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 40px;
    }

    .account-sidebar {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        height: fit-content;
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

    .account-content {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .account-content h2 {
        font-family: 'Cinzel', serif;
        font-size: 24px;
        color: var(--primary);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--secondary);
    }

    .account-section {
        margin-bottom: 30px;
    }

    .account-section h3 {
        font-size: 18px;
        color: var(--primary);
        margin-bottom: 20px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .info-item {
        margin-bottom: 15px;
    }

    .info-item label {
        display: block;
        font-size: 12px;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .info-item p {
        font-weight: 600;
        color: var(--primary);
    }

    .info-edit {
        color: var(--secondary);
        font-size: 13px;
        cursor: pointer;
    }

    .info-edit:hover {
        text-decoration: underline;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-dark);
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

    .btn-sm {
        padding: 10px 20px;
        font-size: 14px;
    }

    .address-card {
        padding: 20px;
        background: var(--bg-light);
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .address-card h4 {
        font-size: 16px;
        color: var(--primary);
        margin-bottom: 10px;
    }

    .address-card p {
        color: var(--text-light);
        font-size: 14px;
        line-height: 1.6;
    }

    .address-actions {
        margin-top: 15px;
    }

    .address-actions a {
        color: var(--secondary);
        margin-right: 15px;
        font-size: 14px;
    }

    .address-actions a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .account-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="account-page">
    <div class="container">        @php
            $nameParts = explode(' ', trim($user->name ?? ''), 2);
            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';
        @endphp
        <h1 style="font-family: 'Cinzel', serif; font-size: 36px; color: var(--primary); margin-bottom: 40px;">My Account</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="account-grid">
            <aside class="account-sidebar">
                <div class="account-user">
                    <div class="account-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h4>{{ $user->name }}</h4>
                    <p>{{ $user->email }}</p>
                </div>

                <ul class="account-menu">
                    <li><a href="{{ route('my-account') }}" class="active"><i class="fas fa-user"></i> My Profile</a></li>
                    <li><a href="{{ route('my-orders') }}"><i class="fas fa-box"></i> My Orders</a></li>
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

            <div class="account-content">
                <h2>My Profile</h2>

                <div class="account-section">
                    <h3>Personal Information</h3>
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $firstName) }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $lastName) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                    </form>
                </div>

                <div class="account-section">
                    <h3>Change Password</h3>
                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
