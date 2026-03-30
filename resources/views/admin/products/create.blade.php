@extends('admin.layout.wrapper')

@section('title', 'Add Product')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Add New Product</h3>
    </div>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label class="form-label">Old Price</label>
            <input type="number" name="old_price" class="form-control" step="0.01">
        </div>
        <div class="form-group">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Material</label>
            <input type="text" name="material" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Dimensions</label>
            <input type="text" name="dimensions" class="form-control" placeholder="e.g., 100x50x80 cm">
        </div>
        <div class="form-group">
            <label class="form-label">Color</label>
            <input type="text" name="color" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Weight (kg)</label>
            <input type="number" name="weight" class="form-control" step="0.01">
        </div>
        <div class="form-group">
            <label class="form-label">
                <input type="checkbox" name="featured" value="1"> Featured Product
            </label>
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Images</label>
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
