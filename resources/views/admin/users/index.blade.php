@extends('admin.layout.wrapper')

@section('title', 'Customers')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Customers</h3>
    </div>
    
    <form action="{{ route('admin.users.index') }}" method="GET" class="search-form">
        <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
        <select name="role" class="form-control">
            <option value="">All Roles</option>
            <option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>Customer</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge badge-{{ $user->role === 'admin' ? 'warning' : 'success' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td class="actions">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary btn-sm">View</a>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
