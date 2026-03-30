@extends('admin.layout.wrapper')

@section('title', 'Footer Menu')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Footer Menu Items</h3>
        <a href="{{ route('admin.footer-menu.create') }}" class="btn btn-primary">Add New Item</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>URL</th>
                <th>Sort</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->url }}</td>
                    <td>{{ $item->sort_order }}</td>
                    <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.footer-menu.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.footer-menu.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this footer link?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No footer menu items found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $items->links() }}
</div>
@endsection
