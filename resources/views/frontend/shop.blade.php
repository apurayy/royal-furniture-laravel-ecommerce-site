@extends('frontend.layout.main')

@section('title', 'Shop - Royal Furniture')

@section('styles')
<style>
    .shop-grid {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 40px;
    }

    .sidebar {
        background: var(--white);
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .sidebar-title {
        font-family: 'Cinzel', serif;
        font-size: 18px;
        color: var(--primary);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--secondary);
    }

    .filter-section {
        margin-bottom: 30px;
    }

    .category-list {
        list-style: none;
    }

    .category-list li {
        margin-bottom: 12px;
    }

    .category-list a {
        color: var(--text-dark);
        font-size: 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .category-list a:hover, .category-list a.active {
        color: var(--secondary);
    }

    .category-list .count {
        color: var(--text-light);
        font-size: 12px;
    }

    .price-range {
        padding: 10px 0;
    }

    .price-inputs {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .price-inputs input {
        width: 100%;
        padding: 10px;
        border: 2px solid var(--border);
        border-radius: 5px;
        font-size: 14px;
    }

    .shop-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .results-count {
        color: var(--text-light);
    }

    .sort-select {
        padding: 10px 15px;
        border: 2px solid var(--border);
        border-radius: 5px;
        font-size: 14px;
        background: var(--white);
        cursor: pointer;
    }

    .shop-products {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 50px;
    }

    .pagination a, .pagination span {
        padding: 10px 15px;
        border: 1px solid var(--border);
        color: var(--text-dark);
        font-size: 14px;
    }

    .pagination a:hover, .pagination .active {
        background: var(--secondary);
        border-color: var(--secondary);
        color: var(--primary);
    }

    @media (max-width: 1024px) {
        .shop-grid {
            grid-template-columns: 1fr;
        }
        .shop-products {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')
<div class="section" style="padding-top: 40px;">
    <div class="container">
        <div class="shop-grid">
            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="filter-section">
                    <h3 class="sidebar-title">Categories</h3>
                    <ul class="category-list">
                        <li><a href="{{ route('shop') }}" class="{{ !request()->category ? 'active' : '' }}">All Categories <span class="count">({{ $categories->sum('products_count') }})</span></a></li>
                        @foreach($categories as $cat)
                        <li><a href="{{ route('category', $cat->slug) }}" class="{{ request()->category == $cat->slug ? 'active' : '' }}">{{ $cat->name }} <span class="count">({{ $cat->products_count }})</span></a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-section">
                    <h3 class="sidebar-title">Price Range</h3>
                    <form action="{{ route('shop') }}" method="GET">
                        @if(request()->category)
                        <input type="hidden" name="category" value="{{ request()->category }}">
                        @endif
                        <div class="price-range">
                            <div class="price-inputs">
                                <input type="number" name="min_price" placeholder="Min" value="{{ request()->min_price }}">
                                <span>-</span>
                                <input type="number" name="max_price" placeholder="Max" value="{{ request()->max_price }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px;">Apply Filter</button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="shop-main">
                <div class="shop-header">
                    <p class="results-count">Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} products</p>
                    <form action="{{ route('shop') }}" method="GET">
                        @if(request()->category)
                        <input type="hidden" name="category" value="{{ request()->category }}">
                        @endif
                        @if(request()->min_price)
                        <input type="hidden" name="min_price" value="{{ request()->min_price }}">
                        @endif
                        @if(request()->max_price)
                        <input type="hidden" name="max_price" value="{{ request()->max_price }}">
                        @endif
                        <select name="sort" class="sort-select" onchange="this.form.submit()">
                            <option value="latest" {{ request()->sort == 'latest' ? 'selected' : '' }}>Sort by: Latest</option>
                            <option value="price_low" {{ request()->sort == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request()->sort == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name_asc" {{ request()->sort == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                            <option value="name_desc" {{ request()->sort == 'name_desc' ? 'selected' : '' }}>Name: Z-A</option>
                        </select>
                    </form>
                </div>

                <div class="shop-products">
                    @forelse($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            @if($product->old_price && $product->old_price > $product->price)
                            <span class="product-badge">{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}% Off</span>
                            @elseif($product->created_at > now()->subDays(7))
                            <span class="product-badge">New</span>
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
                        <p class="text-center">No products found.</p>
                    </div>
                    @endforelse
                </div>

                {!! $products->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
