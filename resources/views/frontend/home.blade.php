@extends('frontend.layout.main')

@section('title', 'Home - Royal Furniture')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-slider">
        @forelse($sliders as $slider)
        <div class="hero-slide" style="background-image: url('{{ asset('uploads/' . $slider->image) }}');" data-order="{{ $slider->order }}">
            <div class="container">
                <div class="hero-content">
                    @if($slider->subtitle)
                    <p class="hero-subtitle">{{ $slider->subtitle }}</p>
                    @else
                    <p class="hero-subtitle">WELCOME TO ROYAL FURNITURE</p>
                    @endif

                    <h1 class="hero-title">{{ $slider->title ?? 'Elegant Furniture for Your Dream Home' }}</h1>
                    @if($slider->button_text && $slider->link)
                    <a href="{{ $slider->link }}" class="btn btn-primary">{{ $slider->button_text }}</a>
                    @else
                    <a href="{{ route('shop') }}" class="btn btn-primary">Shop Now</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="hero-slide" style="background: linear-gradient(135deg, #1A1A2E 0%, #16213E 50%, #0F3460 100%);">
            <div class="container">
                <div class="hero-content">
                    <p class="hero-subtitle">WELCOME TO ROYAL FURNITURE</p>
                    <h1 class="hero-title">Elegant Furniture for Your Dream Home</h1>
                    <p class="hero-desc">Discover our exquisite collection of luxury furniture pieces crafted with precision and elegance.</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.hero-slide');
        if (slides.length) {
            let current = 0;
            slides.forEach((s, i) => { s.classList.toggle('active', i === 0); });
            setInterval(() => {
                slides[current].classList.remove('active');
                current = (current + 1) % slides.length;
                slides[current].classList.add('active');
            }, 5000);
        }
    });
</script>

<!-- Featured Categories -->
<section class="section" style="background: var(--bg-light);">
    <div class="container">
        <div class="section-header">
            <p class="section-subtitle">Browse By</p>
            <h2 class="section-title">Featured Categories</h2>
        </div>
        <div class="category-grid">
            @forelse($categories->take(4) as $category)
            <a href="{{ route('category', $category->slug) }}" class="category-card">
                @if($category->image)
                <img src="{{ asset('uploads/' . $category->image) }}" alt="{{ $category->name }}">
                @else
                <img src="https://via.placeholder.com/300x280/1A1A2E/C9A227?text={{ urlencode($category->name) }}" alt="{{ $category->name }}">
                @endif
                <div class="category-overlay">
                    <h3 class="category-name">{{ $category->name }}</h3>
                    <p class="category-count">{{ $category->products_count }} Products</p>
                </div>
            </a>
            @empty
            <div class="col-12">
                <p class="text-center">No categories available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <p class="section-subtitle">Our Selection</p>
            <h2 class="section-title">Featured Products</h2>
        </div>
        <div class="product-grid">
            @forelse($featuredProducts as $product)
            <div class="product-card">
                <div class="product-image">
                    @if($product->old_price && $product->old_price > $product->price)
                    <span class="product-badge">{{ $product->discount_percent }}% Off</span>
                    @endif
                    @if($product->first_image)
                    <img src="{{ asset('uploads/' . $product->first_image) }}" alt="{{ $product->name }}">
                    @else
                    <img src="https://via.placeholder.com/300x280/1A1A2E/C9A227?text=No+Image" alt="{{ $product->name }}">
                    @endif
                    <div class="product-actions">
                        <button class="product-action" onclick="addToCart({{ $product->id }})"><i class="fas fa-shopping-cart"></i></button>
                        <a href="{{ route('product.show', $product->slug) }}" class="product-action"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <p class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</p>
                    <a href="{{ route('product.show', $product->slug) }}" class="product-name">{{ $product->name }}</a>
                    <div class="product-price">
                        <span class="current-price">{{ currency_format($product->price) }}</span>
                        @if($product->old_price && $product->old_price > $product->price)
                        <span class="old-price">{{ currency_format($product->old_price) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center">No featured products available at the moment.</p>
            </div>
            @endforelse
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('shop') }}" class="btn btn-outline" style="border-color: var(--primary); color: var(--primary);">View All Products</a>
        </div>
    </div>
</section>

<!-- New Arrivals -->
<section class="section" style="background: var(--bg-light);">
    <div class="container">
        <div class="section-header">
            <p class="section-subtitle">Fresh Arrivals</p>
            <h2 class="section-title">New Arrivals</h2>
        </div>
        <div class="product-grid">
            @forelse($newProducts as $product)
            <div class="product-card">
                <div class="product-image">
                    <span class="product-badge">New</span>
                    @if($product->first_image)
                    <img src="{{ asset('uploads/' . $product->first_image) }}" alt="{{ $product->name }}">
                    @else
                    <img src="https://via.placeholder.com/300x280/1A1A2E/C9A227?text=No+Image" alt="{{ $product->name }}">
                    @endif
                    <div class="product-actions">
                        <button class="product-action" onclick="addToCart({{ $product->id }})"><i class="fas fa-shopping-cart"></i></button>
                        <a href="{{ route('product.show', $product->slug) }}" class="product-action"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <p class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</p>
                    <a href="{{ route('product.show', $product->slug) }}" class="product-name">{{ $product->name }}</a>
                    <div class="product-price">
                        <span class="current-price">{{ currency_format($product->price) }}</span>
                        @if($product->old_price && $product->old_price > $product->price)
                        <span class="old-price">{{ currency_format($product->old_price) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center">No new products available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <p class="section-subtitle">Why Choose Us</p>
            <h2 class="section-title">The Royal Difference</h2>
        </div>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;">
            <div style="text-align: center; padding: 40px 20px; background: var(--white); border-radius: 5px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                <div style="width: 80px; height: 80px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-shipping-fast" style="font-size: 32px; color: var(--secondary);"></i>
                </div>
                <h3 style="font-family: 'Cinzel', serif; font-size: 18px; margin-bottom: 15px; color: var(--primary);">Free Shipping</h3>
                <p style="color: var(--text-light); font-size: 14px;">Free delivery on all orders over {{ currency_symbol() }}500 within the country.</p>
            </div>
            <div style="text-align: center; padding: 40px 20px; background: var(--white); border-radius: 5px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                <div style="width: 80px; height: 80px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-award" style="font-size: 32px; color: var(--secondary);"></i>
                </div>
                <h3 style="font-family: 'Cinzel', serif; font-size: 18px; margin-bottom: 15px; color: var(--primary);">Quality Guarantee</h3>
                <p style="color: var(--text-light); font-size: 14px;">All our furniture comes with a 5-year quality warranty.</p>
            </div>
            <div style="text-align: center; padding: 40px 20px; background: var(--white); border-radius: 5px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                <div style="width: 80px; height: 80px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-clock" style="font-size: 32px; color: var(--secondary);"></i>
                </div>
                <h3 style="font-family: 'Cinzel', serif; font-size: 18px; margin-bottom: 15px; color: var(--primary);">Fast Delivery</h3>
                <p style="color: var(--text-light); font-size: 14px;">Quick and reliable delivery within 7-14 business days.</p>
            </div>
            <div style="text-align: center; padding: 40px 20px; background: var(--white); border-radius: 5px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                <div style="width: 80px; height: 80px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-headset" style="font-size: 32px; color: var(--secondary);"></i>
                </div>
                <h3 style="font-family: 'Cinzel', serif; font-size: 18px; margin-bottom: 15px; color: var(--primary);">24/7 Support</h3>
                <p style="color: var(--text-light); font-size: 14px;">Our dedicated support team is always ready to help you.</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="section" style="background: linear-gradient(135deg, var(--primary) 0%, #16213E 100%); padding: 60px 0;">
    <div class="container">
        <div style="text-align: center; color: var(--white);">
            <h2 style="font-family: 'Cinzel', serif; font-size: 32px; margin-bottom: 15px;">Subscribe to Our Newsletter</h2>
            <p style="margin-bottom: 30px; opacity: 0.8;">Get the latest updates on new products and upcoming sales</p>
            <form action="{{ route('contact.store') }}" method="POST" style="display: flex; justify-content: center; gap: 10px; max-width: 500px; margin: 0 auto;">
                @csrf
                <input type="email" name="email" placeholder="Enter your email address" style="flex: 1; padding: 15px 20px; border: none; border-radius: 5px; font-size: 14px;" required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
</section>
@endsection
