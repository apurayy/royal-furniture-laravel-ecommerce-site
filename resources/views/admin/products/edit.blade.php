@extends('admin.layout.wrapper')

@section('title', 'Edit Product')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Product</h3>
    </div>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Old Price</label>
            <input type="number" name="old_price" class="form-control" step="0.01" value="{{ $product->old_price }}">
        </div>
        <div class="form-group">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ $product->sku }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" class="form-control">{{ $product->short_description }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Material</label>
            <input type="text" name="material" class="form-control" value="{{ $product->material }}">
        </div>
        <div class="form-group">
            <label class="form-label">Dimensions</label>
            <input type="text" name="dimensions" class="form-control" value="{{ $product->dimensions }}">
        </div>
        <div class="form-group">
            <label class="form-label">Color</label>
            <input type="text" name="color" class="form-control" value="{{ $product->color }}">
        </div>
        <div class="form-group">
            <label class="form-label">Weight (kg)</label>
            <input type="number" name="weight" class="form-control" step="0.01" value="{{ $product->weight }}">
        </div>
        <div class="form-group">
            <label class="form-label">
                <input type="checkbox" name="featured" value="1" {{ $product->featured ? 'checked' : '' }}> Featured Product
            </label>
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Images</label>
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
            @if($product->images && is_array($product->images) && count($product->images) > 0)
                <div style="display: flex; gap: 10px; margin-top: 10px; flex-wrap: wrap;">
                    @foreach($product->images as $image)
                        <img src="{{ asset('uploads/' . $image) }}" alt="{{ $product->name }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                    @endforeach
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
