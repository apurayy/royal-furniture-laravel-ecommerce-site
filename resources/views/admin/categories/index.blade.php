@extends('admin.layout.wrapper')

@section('title', 'Categories')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Categories</h3>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add New</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Parent</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                <td>
                    <span class="badge badge-{{ $category->status === 'active' ? 'success' : 'danger' }}">
                        {{ ucfirst($category->status) }}
                    </span>
                </td>
                <td class="actions">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
@endsection
