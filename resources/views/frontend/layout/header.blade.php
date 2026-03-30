<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-top-content">
                <div class="header-contact">
                    <span><i class="fas fa-phone"></i> +1 234 567 890</span>
                    <span><i class="fas fa-envelope"></i> info@royalfurniture.com</span>
                </div>
                <div>
                    @auth
                        <a href="{{ route('my-account') }}" style="color: var(--gold-light); font-size: 13px;">My Account</a>
                    @else
                        <a href="{{ route('login') }}" style="color: var(--gold-light); font-size: 13px;">Login</a> |
                        <a href="{{ route('register') }}" style="color: var(--gold-light); font-size: 13px;">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="container">
            <div class="header-main-content">
                <a href="{{ route('home') }}" class="logo">
                    ROYAL
                    <span>FURNITURE</span>
                </a>
                <form action="{{ route('shop') }}" method="GET" class="search-box">
                    <input type="text" name="search" placeholder="Search for furniture...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                <div class="header-actions">
                    <a href="{{ route('my-account') }}" class="header-action">
                        <i class="far fa-user"></i>
                        <span>Account</span>
                    </a>
                    @php
                        if (auth()->check()) {
                            $cart = auth()->user()->cart;
                            if (is_string($cart)) {
                                $cart = json_decode($cart, true);
                            }
                            $cart = is_array($cart) ? $cart : [];
                        } else {
                            $cart = session('cart', []);
                        }
                        $cartCount = $cart ? array_sum(array_column($cart, 'quantity')) : 0;
                    @endphp
                    <a href="{{ route('cart') }}" class="header-action cart-count">
                        <i class="fas fa-shopping-bag"></i>
                        <span>{{ $cartCount }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <nav class="nav">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') || request()->routeIs('category') ? 'active' : '' }}">Shop</a></li>
                <li><a href="{{ route('page', 'about-us') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
    </nav>
</header>
