@extends('admin.layout.wrapper')

@section('title', 'Reviews')

@section('main-content')
@php use Illuminate\Support\Str; @endphp
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Product Reviews</h3>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                    <tr>
                        <td>{{ $review->product->name ?? 'N/A' }}</td>
                        <td>{{ optional($review->user)->name ?? 'Guest' }}</td>
                        <td>{{ $review->rating }} / 5</td>
                        <td>{{ Str::limit($review->comment ?? '-', 80) }}</td>
                        <td>
                            <span class="badge badge-{{ $review->status === 'approved' ? 'success' : 'warning' }}">{{ ucfirst($review->status) }}</span>
                        </td>
                        <td>{{ $review->created_at->format('M d, Y') }}</td>
                        <td class="actions">
                            @if($review->status !== 'approved')
                                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this review?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No reviews found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $reviews->links() }}
    </div>
</div>
@endsection
