@extends('admin.layout.wrapper')

@section('title', 'Edit Page')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Page</h3>
    </div>
    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $page->title }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $page->slug }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" style="min-height: 200px;">{{ $page->content }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ $page->meta_title }}">
        </div>
        <div class="form-group">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control">{{ $page->meta_description }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $page->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $page->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
