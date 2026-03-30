@extends('admin.layout.wrapper')

@section('title', 'Sliders')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sliders</h3>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">Add New</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Status</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
            <tr>
                <td>{{ $slider->id }}</td>
                <td>{{ $slider->title }}</td>
                <td>
                    @if($slider->image)
                        <img src="{{ asset('uploads/' . $slider->image) }}" alt="{{ $slider->title }}" style="width: 100px; height: 50px; object-fit: cover; border-radius: 5px;">
                    @else
                        <span style="color: var(--text-secondary);">No Image</span>
                    @endif
                </td>
                <td>
                    <span class="badge badge-{{ $slider->status === 'active' ? 'success' : 'danger' }}">
                        {{ ucfirst($slider->status) }}
                    </span>
                </td>
                <td>{{ $slider->order }}</td>
                <td class="actions">
                    <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sliders->links() }}
</div>
@endsection
