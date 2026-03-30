@extends('frontend.layout.main')

@section('title', 'Product Details - Royal Furniture')

@section('styles')
<style>
    .product-detail {
        padding: 40px 0;
    }

    .product-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
    }

    .product-gallery {
        position: sticky;
        top: 100px;
    }

    .main-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .thumbnail-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .thumbnail {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s;
    }

    .thumbnail:hover, .thumbnail.active {
        border-color: var(--secondary);
    }

    .product-detail-info h1 {
        font-size: 36px;
        color: var(--primary);
        margin-bottom: 15px;
    }

    .product-detail-price {
        font-size: 28px;
        color: var(--secondary);
        font-weight: 700;
        margin-bottom: 20px;
    }

    .product-detail-price .old-price {
        font-size: 18px;
        color: var(--text-light);
        text-decoration: line-through;
        margin-left: 15px;
    }

    .product-short-desc {
        color: var(--text-light);
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .product-meta {
        margin-bottom: 25px;
        padding: 15px 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }

    .product-meta p {
        display: flex;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .product-meta strong {
        min-width: 120px;
        color: var(--primary);
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .quantity-selector label {
        font-weight: 600;
        color: var(--primary);
    }

    .quantity-input {
        display: flex;
        align-items: center;
        border: 2px solid var(--border);
        border-radius: 5px;
        overflow: hidden;
    }

    .quantity-input button {
        padding: 10px 15px;
        border: none;
        background: var(--bg-light);
        cursor: pointer;
        font-size: 16px;
    }

    .quantity-input button:hover {
        background: var(--secondary);
    }

    .quantity-input input {
        width: 60px;
        text-align: center;
        border: none;
        padding: 10px;
        font-size: 16px;
    }

    .product-actions {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .product-actions .btn {
        flex: 1;
        text-align: center;
    }

    .product-tabs {
        margin-top: 60px;
    }

    .tabs-header {
        display: flex;
        border-bottom: 2px solid var(--border);
        margin-bottom: 30px;
    }

    .tab-btn {
        padding: 15px 30px;
        border: none;
        background: none;
        font-size: 16px;
        font-weight: 600;
        color: var(--text-light);
        cursor: pointer;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
    }

    .tab-btn:hover, .tab-btn.active {
        color: var(--primary);
    }

    .tab-btn.active {
        border-bottom-color: var(--secondary);
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .tab-content p {
        line-height: 1.8;
        color: var(--text-light);
    }

    .specs-table {
        width: 100%;
        border-collapse: collapse;
    }

    .specs-table tr {
        border-bottom: 1px solid var(--border);
    }

    .specs-table td {
        padding: 15px;
    }

    .specs-table td:first-child {
        font-weight: 600;
        color: var(--primary);
        width: 200px;
    }

    .review-item {
        padding: 20px;
        background: var(--bg-light);
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .review-author {
        font-weight: 600;
        color: var(--primary);
    }

    .review-date {
        color: var(--text-light);
        font-size: 13px;
    }

    .review-rating {
        color: var(--secondary);
        margin-bottom: 10px;
    }

    .related-products {
        margin-top: 60px;
    }

    @media (max-width: 768px) {
        .product-detail-grid {
            grid-template-columns: 1fr;
        }
        .product-gallery {
            position: static;
        }
    }
</style>
@endsection

@section('content')
<div class="product-detail">
    <div class="container">
        <div class="product-detail-grid">
            <!-- Image Gallery -->
            <div class="product-gallery">
                @php
                    $mainImage = $product->first_image ?? 'https://via.placeholder.com/600x500';
                    $galleryImages = collect([$product->first_image])->merge($product->images ?? collect())->filter()->unique()->values();
                @endphp

                <img src="{{ $mainImage }}" alt="Product Image" class="main-image" id="mainImage">
                <div class="thumbnail-grid">
                    @foreach($galleryImages->take(4) as $index => $img)
                        <img src="{{ $img }}" alt="Thumbnail {{ $index + 1 }}" class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="changeImage(this, '{{ $img }}')">
                    @endforeach
                    @if($galleryImages->isEmpty())
                        <img src="https://via.placeholder.com/150x100/1A1A2E/C9A227?text=No+Image" alt="No image" class="thumbnail active" onclick="changeImage(this, 'https://via.placeholder.com/600x500')">
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-detail-info">
                <p class="product-category">{{ optional($product->category)->name ?? 'Uncategorized' }}</p>
                <h1>{{ $product->name }}</h1>
                <div class="product-detail-price">
                    {{ currency_symbol() }} {{ number_format($product->price, 0, '.', ',') }}
                    @if($product->sale_price && $product->sale_price < $product->price)
                        <span class="old-price">{{ currency_symbol() }} {{ number_format($product->price, 0, '.', ',') }}</span>
                    @endif
                </div>
                <p class="product-short-desc">
                    {{ $product->description ?? 'No description available.' }}
                </p>

                <div class="product-meta">
                    <p><strong>SKU:</strong> {{ $product->sku ?? 'N/A' }}</p>
                    <p><strong>Category:</strong> {{ optional($product->category)->name ?? 'Uncategorized' }}</p>
                    <p><strong>Tags:</strong> {{ $product->tags ?? 'N/A' }}</p>
                </div>

                <div class="quantity-selector">
                    <label>Quantity:</label>
                    <div class="quantity-input">
                        <button type="button" onclick="decrementQty()">-</button>
                        <input type="number" id="quantity" value="1" min="1" max="10">
                        <button type="button" onclick="incrementQty()">+</button>
                    </div>
                </div>

                <div class="product-actions">
                    <button class="btn btn-primary" onclick="addToCart({{ $product->id }}, parseInt(document.getElementById('quantity').value))">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                    <button class="btn btn-outline" style="border-color: var(--primary); color: var(--primary);">
                        <i class="far fa-heart"></i> Wishlist
                    </button>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="product-tabs">
            <div class="tabs-header">
                <button class="tab-btn active" onclick="openTab(event, 'description')">Description</button>
                <button class="tab-btn" onclick="openTab(event, 'specifications')">Specifications</button>
                <button class="tab-btn" onclick="openTab(event, 'reviews')">Reviews (5)</button>
            </div>

            <div id="description" class="tab-content active">
                <h3 style="margin-bottom: 20px; color: var(--primary);">Product Description</h3>
                <p>The Classic Velvet Sofa represents the perfect blend of traditional craftsmanship and contemporary design. Each piece is meticulously crafted using time-honored techniques passed down through generations of furniture makers.</p>
                <br>
                <p>Features premium high-resilience foam cushions that maintain their shape over time, a solid hardwood frame with kiln-dried joinery for exceptional durability, and soft velvet upholstery that adds a luxurious touch to any room.</p>
                <br>
                <p>Available in multiple colors to complement your existing decor. Professional cleaning recommended for lasting beauty.</p>
            </div>

            <div id="specifications" class="tab-content">
                <h3 style="margin-bottom: 20px; color: var(--primary);">Technical Specifications</h3>
                <table class="specs-table">
                    <tr>
                        <td>Dimensions</td>
                        <td>84" W x 36" D x 32" H</td>
                    </tr>
                    <tr>
                        <td>Weight Capacity</td>
                        <td>600 lbs</td>
                    </tr>
                    <tr>
                        <td>Frame Material</td>
                        <td>Solid Hardwood</td>
                    </tr>
                    <tr>
                        <td>Upholstery</td>
                        <td>Premium Velvet (100% Polyester)</td>
                    </tr>
                    <tr>
                        <td>Cushion Fill</td>
                        <td>High-Density Foam</td>
                    </tr>
                    <tr>
                        <td>Leg Material</td>
                        <td>Solid Oak Wood</td>
                    </tr>
                    <tr>
                        <td>Assembly</td>
                        <td>Minimal Assembly Required</td>
                    </tr>
                    <tr>
                        <td>Warranty</td>
                        <td>5 Years on Frame, 2 Years on Cushions</td>
                    </tr>
                </table>
            </div>

            <div id="reviews" class="tab-content">
                <h3 style="margin-bottom: 20px; color: var(--primary);">Customer Reviews</h3>

                <div class="review-item">
                    <div class="review-header">
                        <span class="review-author">John D.</span>
                        <span class="review-date">December 15, 2025</span>
                    </div>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>Absolutely stunning sofa! The quality is exceptional and it looks even better in person. Very comfortable and the velvet fabric is so soft. Highly recommend!</p>
                </div>

                <div class="review-item">
                    <div class="review-header">
                        <span class="review-author">Sarah M.</span>
                        <span class="review-date">November 28, 2025</span>
                    </div>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p>Great sofa for the price. Delivery was on time and the delivery team was very professional. The color is exactly as shown. Only minor issue is the cushion firmness, but it's still comfortable.</p>
                </div>

                <div class="review-item">
                    <div class="review-header">
                        <span class="review-author">Michael R.</span>
                        <span class="review-date">October 5, 2025</span>
                    </div>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>This is my second purchase from Royal Furniture. Once again, excellent quality and beautiful design. The customer service team was very helpful in choosing the right size.</p>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="related-products">
            <div class="section-header">
                <p class="section-subtitle">You May Also Like</p>
                <h2 class="section-title">Related Products</h2>
            </div>
            <div class="product-grid">
                @foreach($relatedProducts as $related)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ $related->first_image ?? 'https://via.placeholder.com/300x280' }}" alt="{{ $related->name }}">
                            <div class="product-actions">
                                <button class="product-action" onclick="addToCart({{ $related->id }}, 1)"><i class="fas fa-shopping-cart"></i></button>
                                <a href="{{ route('product.show', $related->slug) }}" class="product-action"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="product-info">
                            <p class="product-category">{{ optional($related->category)->name ?? 'Uncategorized' }}</p>
                            <a href="{{ route('product.show', $related->slug) }}" class="product-name">{{ $related->name }}</a>
                            <div class="product-price">
                                <span class="current-price">{{ currency_symbol() }} {{ number_format($related->price, 0, '.', ',') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(thumbnail, src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
        thumbnail.classList.add('active');
    }

    function incrementQty() {
        let qty = parseInt(document.getElementById('quantity').value);
        if (qty < 10) {
            document.getElementById('quantity').value = qty + 1;
        }
    }

    function decrementQty() {
        let qty = parseInt(document.getElementById('quantity').value);
        if (qty > 1) {
            document.getElementById('quantity').value = qty - 1;
        }
    }

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
            tabcontent[i].classList.remove("active");
        }
        tablinks = document.getElementsByClassName("tab-btn");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        document.getElementById(tabName).classList.add("active");
        evt.currentTarget.className += " active";
    }
</script>
@endsection
