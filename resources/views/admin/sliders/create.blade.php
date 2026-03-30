@extends('admin.layout.wrapper')

@section('title', 'Add Slider')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Add New Slider</h3>
    </div>
    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Subtitle</label>
            <textarea name="subtitle" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <div class="form-group">
            <label class="form-label">Link</label>
            <input type="url" name="link" class="form-control" placeholder="https://">
        </div>
        <div class="form-group">
            <label class="form-label">Button Text</label>
            <input type="text" name="button_text" class="form-control" placeholder="e.g., Shop Now">
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Order</label>
            <input type="number" name="order" class="form-control" value="0">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
