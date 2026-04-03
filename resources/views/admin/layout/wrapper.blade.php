@extends('admin.layout.main')

@section('content')
<div class="admin-wrapper">
    <aside class="sidebar">
        <div class="sidebar-logo">
            <h1><i class="fas fa-crown"></i> Royal</h1>
            <span>ADMIN PANEL</span>
            <span><a style="color: #DDB52F;" href="{{ route('home') }}" target="_blank">Visit Site</a></span>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}" class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> Categories
            </a>
            <a href="{{ route('admin.products.index') }}" class="menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="fas fa-box"></i> Products
            </a>
            <a href="{{ route('admin.orders.index') }}" class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i> Orders
            </a>
            <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Customers
            </a>
            <a href="{{ route('admin.sliders.index') }}" class="menu-item {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Sliders
            </a>
            <a href="{{ route('admin.pages.index') }}" class="menu-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Pages
            </a>
            <a href="{{ route('admin.footer-menu.index') }}" class="menu-item {{ request()->routeIs('admin.footer-menu.*') ? 'active' : '' }}">
                <i class="fas fa-link"></i> Footer Menu
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="menu-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Messages
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="menu-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                <i class="fas fa-star"></i> Reviews
            </a>
            <a href="{{ route('admin.settings') }}" class="menu-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> Settings
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="menu-item" style="width: 100%; background: none; border: none; cursor: pointer; text-align: left;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <div class="main-content">
        <header class="header">
            <h2 class="header-title">@yield('title', 'Dashboard')</h2>
            <div class="header-user">
                <span>Welcome, {{ auth()->user()->name }}</span>
                <i class="fas fa-user-circle" style="font-size: 24px; color: var(--primary);"></i>
            </div>
        </header>

        <main class="page-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('main-content')
        </main>
    </div>
</div>
@endsection
