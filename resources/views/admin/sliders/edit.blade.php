@extends('admin.layout.wrapper')

@section('title', 'Edit Slider')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Slider</h3>
    </div>
    <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $slider->title }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Subtitle</label>
            <textarea name="subtitle" class="form-control">{{ $slider->subtitle }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @if($slider->image)
                <div class="image-preview">
                    <img src="{{ asset('uploads/' . $slider->image) }}" alt="{{ $slider->title }}" style="max-width: 180px; max-height: 100px; object-fit: cover; margin-top: 10px;">
                </div>
            @endif
        </div>
        <div class="form-group">
            <label class="form-label">Link</label>
            <input type="url" name="link" class="form-control" value="{{ $slider->link }}">
        </div>
        <div class="form-group">
            <label class="form-label">Button Text</label>
            <input type="text" name="button_text" class="form-control" value="{{ $slider->button_text }}">
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $slider->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $slider->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Order</label>
            <input type="number" name="order" class="form-control" value="{{ $slider->order }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
