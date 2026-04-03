<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Royal Furniture')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Lato:wght@300;400;700&family=Cinzel:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #1A1A2E;
            --secondary: #C9A227;
            --accent: #8B7355;
            --bg-light: #F5F0E8;
            --text-dark: #2C2C2C;
            --text-light: #666666;
            --white: #FFFFFF;
            --border: #D4C4A8;
            --gold-light: #E8D5A3;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        .royal-heading {
            font-family: 'Cinzel', serif;
            color: var(--primary);
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        .header {
            background: var(--primary);
            color: var(--white);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .header-top {
            background: linear-gradient(135deg, var(--primary) 0%, #16213E 100%);
            padding: 8px 0;
            border-bottom: 1px solid rgba(201, 162, 39, 0.3);
        }

        .header-top-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-contact {
            display: flex;
            gap: 20px;
            font-size: 13px;
        }

        .header-contact span {
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--gold-light);
        }

        .header-main {
            padding: 20px 0;
        }

        .header-main-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Cinzel', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--secondary);
            letter-spacing: 3px;
        }

        .logo span {
            color: var(--white);
            font-size: 12px;
            display: block;
            letter-spacing: 5px;
            font-weight: 400;
        }

        .search-box {
            display: flex;
            flex: 1;
            max-width: 500px;
            margin: 0 30px;
        }

        .search-box input {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid var(--secondary);
            border-right: none;
            background: var(--white);
            font-size: 14px;
        }

        .search-box button {
            padding: 12px 25px;
            background: var(--secondary);
            border: none;
            color: var(--primary);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .search-box button:hover {
            background: var(--gold-light);
        }

        .header-actions {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .header-action {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--white);
            font-size: 12px;
        }

        .header-action i {
            font-size: 20px;
            margin-bottom: 3px;
            color: var(--secondary);
        }

        .header-action:hover {
            color: var(--secondary);
        }

        .cart-count {
            position: relative;
        }

        .cart-count span {
            position: absolute;
            top: -8px;
            right: -10px;
            background: var(--secondary);
            color: var(--primary);
            font-size: 10px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* Navigation */
        .nav {
            background: rgba(26, 26, 46, 0.95);
            padding: 0;
        }

        .nav ul {
            display: flex;
            list-style: none;
            gap: 0;
        }

        .nav li {
            position: relative;
        }

        .nav a {
            display: block;
            padding: 15px 25px;
            color: var(--white);
            font-weight: 500;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-bottom: 3px solid transparent;
        }

        .nav a:hover, .nav a.active {
            background: var(--secondary);
            color: var(--primary);
            border-bottom-color: var(--accent);
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 600px;
            overflow: hidden;
        }

        .hero-slider {
            height: 100%;
            position: relative;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            display: none;
            align-items: center;
        }

        .hero-slide.active {
            display: flex;
        }

        .hero-slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(26, 26, 46, 0.8) 0%, rgba(26, 26, 46, 0.4) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 600px;
            color: var(--white);
        }

        .hero-subtitle {
            font-family: 'Cinzel', serif;
            font-size: 16px;
            color: var(--secondary);
            letter-spacing: 5px;
            margin-bottom: 15px;
        }

        .hero-title {
            font-size: 52px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-desc {
            font-size: 16px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--secondary);
            color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--secondary);
            color: var(--white);
        }

        .btn-outline:hover {
            background: var(--secondary);
            color: var(--primary);
        }

        /* Sections */
        .section {
            padding: 80px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-subtitle {
            font-family: 'Cinzel', serif;
            font-size: 14px;
            color: var(--secondary);
            letter-spacing: 5px;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 42px;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: var(--secondary);
            margin: 20px auto 0;
        }

        /* Categories */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .category-card {
            position: relative;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .category-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: all 0.5s;
        }

        .category-card:hover img {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(to top, rgba(26, 26, 46, 0.9), transparent);
            color: var(--white);
        }

        .category-name {
            font-family: 'Cinzel', serif;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .category-count {
            font-size: 13px;
            opacity: 0.8;
        }

        /* Products */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .product-card {
            background: var(--white);
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .product-image {
            position: relative;
            overflow: hidden;
            height: 280px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--secondary);
            color: var(--primary);
            padding: 5px 15px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .product-actions {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: all 0.3s;
        }

        .product-card:hover .product-actions {
            opacity: 1;
        }

        .product-action {
            width: 45px;
            height: 45px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .product-action:hover {
            background: var(--secondary);
            color: var(--white);
        }

        .product-info {
            padding: 20px;
        }

        .product-category {
            font-size: 12px;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .product-name {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .product-name:hover {
            color: var(--secondary);
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .current-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--secondary);
        }

        .old-price {
            font-size: 14px;
            color: var(--text-light);
            text-decoration: line-through;
        }

        /* Footer */
        .footer {
            background: var(--primary);
            color: var(--white);
            padding: 60px 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-title {
            font-family: 'Cinzel', serif;
            font-size: 18px;
            margin-bottom: 25px;
            color: var(--secondary);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.7);
            font-size: 14px;
        }

        .footer-links a:hover {
            color: var(--secondary);
        }

        .footer-contact p {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            color: rgba(255,255,255,0.7);
            font-size: 14px;
        }

        .footer-contact i {
            color: var(--secondary);
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            transition: all 0.3s;
        }

        .social-link:hover {
            background: var(--secondary);
            color: var(--primary);
        }

        .footer-bottom {
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            font-size: 14px;
            color: rgba(255,255,255,0.5);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .category-grid, .product-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .category-grid, .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .hero-title {
                font-size: 36px;
            }
            .search-box {
                display: none;
            }
            .nav ul {
                flex-wrap: wrap;
            }
            .footer-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Cart & Checkout Styles */
        .cart-page, .checkout-page {
            padding: 40px 0;
        }

        .cart-table, .checkout-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white);
            border-radius: 5px;
            overflow: hidden;
        }

        .cart-table th, .cart-table td, .checkout-table th, .checkout-table td {
            padding: 20px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .cart-table th {
            background: var(--primary);
            color: var(--white);
            font-weight: 600;
        }

        .cart-summary {
            background: var(--white);
            padding: 30px;
            border-radius: 5px;
            margin-left: 30px;
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
    </style>
    @yield('styles')
</head>
<body>
    @include('frontend.layout.header')

    @yield('content')

    @include('frontend.layout.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Cart functionality
        function addToCart(productId, quantity = 1, callback = null) {
            $.ajax({
                url: '{{ route("cart.add") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    if(response.success) {
                        alert(response.message);
                        updateCartCount(response.cart_count);
                        if (typeof callback === 'function') {
                            callback(response);
                        }
                    }
                }
            });
        }

        function buyNow(productId, quantity = 1) {
            addToCart(productId, quantity, function() {
                window.location = '{{ route("checkout") }}';
            });
        }

        function updateCartCount(count) {
            var $cartCount = document.querySelector('.cart-count span');
            if ($cartCount) {
                $cartCount.textContent = count;
            }
        }

        function updateCart(productId, quantity) {
            $.ajax({
                url: '{{ route("cart.update") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    if(response.success) {
                        location.reload();
                    }
                }
            });
        }

        function removeFromCart(productId) {
            if(confirm('Are you sure you want to remove this item?')) {
                $.ajax({
                    url: '{{ route("cart.remove") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId
                    },
                    success: function(response) {
                        if(response.success) {
                            location.reload();
                        }
                    }
                });
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
