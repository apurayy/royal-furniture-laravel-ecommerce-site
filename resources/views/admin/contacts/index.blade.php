@extends('admin.layout.wrapper')

@section('title', 'Messages')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Messages</h3>
    </div>
    
    <form action="{{ route('admin.contacts.index') }}" method="GET" class="search-form">
        <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
        <select name="status" class="form-control">
            <option value="">All Status</option>
            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->subject }}</td>
                <td>
                    <span class="badge badge-{{ $contact->status === 'unread' ? 'warning' : 'success' }}">
                        {{ ucfirst($contact->status) }}
                    </span>
                </td>
                <td>{{ $contact->created_at->format('M d, Y') }}</td>
                <td class="actions">
                    <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-primary btn-sm">View</a>
                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
</div>
@endsection
