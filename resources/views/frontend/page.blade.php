@extends('frontend.layout.main')

@section('title', $page->title ?? 'Page - Royal Furniture')

@section('styles')
<style>
    .page-content {
        padding: 60px 0;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 50px;
        padding-bottom: 30px;
        border-bottom: 2px solid var(--secondary);
    }
    
    .page-header h1 {
        font-family: 'Cinzel', serif;
        font-size: 42px;
        color: var(--primary);
        margin-bottom: 15px;
    }
    
    .page-header p {
        color: var(--text-light);
        font-size: 16px;
    }
    
    .page-body {
        background: var(--white);
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    
    .page-body h2 {
        font-family: 'Cinzel', serif;
        font-size: 28px;
        color: var(--primary);
        margin: 30px 0 20px;
    }
    
    .page-body h3 {
        font-size: 22px;
        color: var(--primary);
        margin: 25px 0 15px;
    }
    
    .page-body p {
        color: var(--text-dark);
        line-height: 1.8;
        margin-bottom: 20px;
    }
    
    .page-body ul, .page-body ol {
        margin-bottom: 20px;
        padding-left: 25px;
    }
    
    .page-body li {
        line-height: 1.8;
        margin-bottom: 10px;
    }
    
    .page-body a {
        color: var(--secondary);
    }
    
    .page-body a:hover {
        text-decoration: underline;
    }
    
    .page-body img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin: 20px 0;
    }
    
    .page-body blockquote {
        border-left: 4px solid var(--secondary);
        padding-left: 20px;
        margin: 20px 0;
        font-style: italic;
        color: var(--text-light);
    }
    
    .page-body table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    
    .page-body table th, .page-body table td {
        padding: 12px;
        border: 1px solid var(--border);
        text-align: left;
    }
    
    .page-body table th {
        background: var(--bg-light);
        color: var(--primary);
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="page-content">
    <div class="container">
        <div class="page-header">
            <h1>{{ $page->title ?? 'Page Title' }}</h1>
            @if(isset($page->excerpt) && $page->excerpt)
            <p>{{ $page->excerpt }}</p>
            @endif
        </div>
        
        <div class="page-body">
            @if(isset($page))
                {!! $page->content !!}
            @else
                <h2>Welcome to Royal Furniture</h2>
                <p>Thank you for visiting our website. This page is currently being updated.</p>
                <p>Please check back soon or contact us if you have any questions.</p>
                
                <h3>About Us</h3>
                <p>Royal Furniture has been providing high-quality furniture to homes across the country since 1985. Our commitment to quality, craftsmanship, and customer satisfaction has made us a trusted name in the furniture industry.</p>
                
                <h3>Our Mission</h3>
                <p>To provide elegant, high-quality furniture that transforms houses into homes, while delivering exceptional customer service at every step.</p>
                
                <h3>Why Choose Us?</h3>
                <ul>
                    <li>Premium quality materials and craftsmanship</li>
                    <li>5-year warranty on all furniture</li>
                    <li>Free shipping on orders over $500</li>
                    <li>24/7 customer support</li>
                    <li>Easy returns and exchanges</li>
                </ul>
                
                <h3>Contact Us</h3>
                <p>If you have any questions, please don't hesitate to contact us at <a href="mailto:info@royalfurniture.com">info@royalfurniture.com</a> or call us at +1 234 567 890.</p>
            @endif
        </div>
    </div>
</div>
@endsection
