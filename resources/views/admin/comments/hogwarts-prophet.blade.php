@extends('admin.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Hogwarts Prophet Comments</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.comments.index') }}">Comments</a></li>
        <li class="breadcrumb-item active">Hogwarts Prophet</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">All Comments ({{ $comments->total() }})</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Article</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>
                                    @if($comment->article)
                                        <small>{{ Str::limit($comment->article->title, 50) }}</small>
                                    @else
                                        <span class="text-muted">Article Deleted</span>
                                    @endif
                                </td>
                                <td>{{ $comment->name ?: 'Anonymous' }}</td>
                                <td>
                                    <small>{{ Str::limit($comment->content, 100) }}</small>
                                </td>
                                <td>
                                    @if($comment->is_approved)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $comment->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info toggle-approval" 
                                            data-type="prophet" 
                                            data-id="{{ $comment->id }}"
                                            data-approved="{{ $comment->is_approved }}">
                                        <i class="fas fa-toggle-{{ $comment->is_approved ? 'on' : 'off' }}"></i>
                                    </button>
                                    <form action="{{ route('admin.comments.hogwarts-prophet.delete', $comment->id) }}" 
                                          method="POST" 
                                          style="display:inline-block;"
                                          onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No comments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-approval').forEach(button => {
        button.addEventListener('click', function() {
            const type = this.dataset.type;
            const id = this.dataset.id;

            fetch('{{ route("admin.comments.toggle-approval") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ type, id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(err => console.error('Error:', err));
        });
    });
});
</script>
@endsection
