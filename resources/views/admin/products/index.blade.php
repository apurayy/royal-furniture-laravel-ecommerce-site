@extends('admin.layout.wrapper')

@section('title', 'Products')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Products</h3>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New</a>
    </div>

    <form action="{{ route('admin.products.index') }}" method="GET" class="search-form">
        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
        <select name="category" class="form-control">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="status" class="form-control">
            <option value="">All Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->first_image)
                        <img src="{{ asset('uploads/' . $product->first_image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    @else
                        <span style="color: var(--text-secondary);">No Image</span>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ currency_format($product->price) }}</td>
                <td>
                    @if($product->stock_quantity > 0)
                        <span class="badge badge-success">{{ $product->stock_quantity }}</span>
                    @else
                        <span class="badge badge-danger">Out of Stock</span>
                    @endif
                </td>
                <td>
                    <span class="badge badge-{{ $product->status === 'active' ? 'success' : 'danger' }}">
                        {{ ucfirst($product->status) }}
                    </span>
                </td>
                <td class="actions">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection
