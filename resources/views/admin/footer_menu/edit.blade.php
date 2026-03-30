@extends('admin.layout.wrapper')

@section('title', 'Edit Footer Menu Item')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Footer Menu Item</h3>
    </div>

    <form action="{{ route('admin.footer-menu.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $item->title) }}" required>
        </div>

        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" name="url" id="url" class="form-control" value="{{ old('url', $item->url) }}" required>
        </div>

        <div class="form-group">
            <label for="section">Section</label>
            <select name="section" id="section" class="form-control" required>
                <option value="footer_links" {{ old('section', $item->section) === 'footer_links' ? 'selected' : '' }}>Footer Links</option>
                <option value="customer_service" {{ old('section', $item->section) === 'customer_service' ? 'selected' : '' }}>Customer Service</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $item->sort_order) }}">
        </div>

        <div class="form-check">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
        </div>

        <div class="form-check">
            <input type="checkbox" name="opens_in_new_tab" id="opens_in_new_tab" class="form-check-input" {{ old('opens_in_new_tab', $item->opens_in_new_tab) ? 'checked' : '' }}>
            <label for="opens_in_new_tab" class="form-check-label">Open in new tab</label>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.footer-menu.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
