@extends('admin.layout.wrapper')

@section('title', 'Edit Category')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Category</h3>
    </div>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Parent Category</label>
            <select name="parent_id" class="form-control">
                <option value="">None</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @if($category->image)
                <div class="image-preview">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                </div>
            @endif
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
