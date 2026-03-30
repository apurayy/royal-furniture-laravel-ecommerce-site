<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::where('parent_id', null)->where('status', 'active')->get();
        return view('admin.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $slug = Str::slug($request->name);
        if (Category::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $image = null;
        if ($request->hasFile('image')) {
            $image = $this->uploadImage($request->file('image'));
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $image,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $parents = Category::where('parent_id', null)->where('status', 'active')->where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $slug = Str::slug($request->name);
        if (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $slug . '-' . time();
        }

        $image = $category->image;
        if ($request->hasFile('image')) {
            if ($category->image) {
                File::delete(public_path('uploads/' . $category->image));
            }
            $image = $this->uploadImage($request->file('image'));
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $image,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            File::delete(public_path('uploads/' . $category->image));
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    private function uploadImage($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        return $filename;
    }
}
