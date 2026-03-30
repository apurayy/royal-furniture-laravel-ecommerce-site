<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $products = $query->latest()->paginate(20);
        $categories = Category::where('status', 'active')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $slug = Str::slug($request->name);
        if (Product::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $this->uploadImage($image);
            }
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'sku' => $request->sku,
            'stock_quantity' => $request->stock_quantity ?? 0,
            'images' => $images,
            'material' => $request->material,
            'dimensions' => $request->dimensions,
            'color' => $request->color,
            'weight' => $request->weight,
            'featured' => $request->featured ? true : false,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('variants', 'category');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $slug = Str::slug($request->name);
        if (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $slug . '-' . time();
        }

        $images = is_array($product->images) ? $product->images : [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $this->uploadImage($image);
            }
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'sku' => $request->sku,
            'stock_quantity' => $request->stock_quantity ?? 0,
            'images' => $images,
            'material' => $request->material,
            'dimensions' => $request->dimensions,
            'color' => $request->color,
            'weight' => $request->weight,
            'featured' => $request->featured ? true : false,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $images = is_array($product->images) ? $product->images : [];
        foreach ($images as $image) {
            File::delete(public_path('uploads/' . $image));
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    private function uploadImage($file)
    {
        $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        return $filename;
    }
}
