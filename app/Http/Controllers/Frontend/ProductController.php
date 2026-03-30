<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->take(4)
            ->get();
        $reviews = $product->reviews()->where('status', 'approved')->latest()->take(10)->get();
        
        return view('frontend.product', compact('product', 'relatedProducts', 'reviews'));
    }

    public function review(Request $request, $slug)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();
        
        Review::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Review submitted successfully. It will be visible after approval.');
    }
}
