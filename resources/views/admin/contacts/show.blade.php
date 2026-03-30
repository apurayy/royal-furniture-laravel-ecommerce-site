@extends('admin.layout.wrapper')

@section('title', 'Message Details')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Message Details</h3>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
    
    <div style="margin-bottom: 20px;">
        <p><strong>Name:</strong> {{ $contact->name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Subject:</strong> {{ $contact->subject }}</p>
        <p><strong>Status:</strong> 
            <span class="badge badge-{{ $contact->status === 'unread' ? 'warning' : 'success' }}">
                {{ ucfirst($contact->status) }}
            </span>
        </p>
        <p><strong>Date:</strong> {{ $contact->created_at->format('M d, Y h:i A') }}</p>
    </div>
    
    <div style="background: var(--bg-dark); padding: 20px; border-radius: 5px; border: 1px solid var(--border);">
        <h4 style="color: var(--primary); margin-bottom: 15px;">Message</h4>
        <p style="white-space: pre-wrap;">{{ $contact->message }}</p>
    </div>

    <div style="margin-top: 20px; display: flex; gap: 10px;">
        <a href="mailto:{{ $contact->email }}" class="btn btn-primary">Reply</a>
        @if($contact->status === 'unread')
        <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="read">
            <button type="submit" class="btn btn-success">Mark as Read</button>
        </form>
        @endif
        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
</div>
@endsection
