@extends('frontend.layout.main')

@section('title', 'Wishlist - Royal Furniture')

@section('content')
<div class="container" style="padding: 40px 0;">
    <h1 style="font-family: 'Cinzel', serif; font-size: 36px; color: var(--primary); margin-bottom: 30px;">My Wishlist</h1>
    <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
        <p class="mb-0">Your wishlist is currently empty. Add products from the shop to save them for later.</p>
    </div>
</div>
@endsection
