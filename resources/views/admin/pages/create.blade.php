@extends('admin.layout.wrapper')

@section('title', 'Add Page')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Add New Page</h3>
    </div>
    <form action="{{ route('admin.pages.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" style="min-height: 200px;"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
