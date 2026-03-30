@extends('admin.layout.wrapper')

@section('title', 'Pages')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pages</h3>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Add New</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->slug }}</td>
                <td>
                    <span class="badge badge-{{ $page->status === 'active' ? 'success' : 'danger' }}">
                        {{ ucfirst($page->status) }}
                    </span>
                </td>
                <td class="actions">
                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pages->links() }}
</div>
@endsection
