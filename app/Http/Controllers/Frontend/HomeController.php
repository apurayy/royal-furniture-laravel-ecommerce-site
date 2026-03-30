<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'active')->orderBy('order')->get();
        $featuredProducts = Product::where('featured', true)->where('status', 'active')->with('category')->latest()->take(8)->get();
        $categories = Category::where('status', 'active')->where('parent_id', null)->with('children')->withCount('products')->get();
        $newProducts = Product::where('status', 'active')->with('category')->latest()->take(8)->get();

        $siteName = Setting::get('site_name', 'Royal Furniture');

        return view('frontend.home', compact('sliders', 'featuredProducts', 'categories', 'newProducts', 'siteName'));
    }
}
