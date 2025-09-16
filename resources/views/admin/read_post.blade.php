@extends('backend.master') {{-- or your backend layout --}}
@section('main')

<style>
    .card-elevated { border: 0; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,.08); }
    .table thead th { background: #0f172a; color: #fff; border: 0; }
    .table tbody tr:hover { background: #f8fafc; }
    .thumb {
        width: 72px; height: 72px; object-fit: cover; border-radius: 10px; border: 1px solid #e5e7eb;
    }
    .truncate-2 {
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        max-width: 520px;
    }
    .badge-tag { background:#eef2ff; color:#3730a3; border:1px solid #c7d2fe; font-weight:500; }
    .toolbar .form-control { border-radius: 10px; }
    .btn-soft {
        background: #f1f5f9; border: 1px solid #e2e8f0; color: #0f172a;
    }
    .btn-soft:hover { background: #e2e8f0; }
</style>

<div class="container py-4">
    <div class="card card-elevated">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h3 class="mb-0">Posts</h3>
                    <small class="text-muted">Manage your posts, images, and metadata</small>
                </div>
                <div class="d-flex align-items-center gap-2 toolbar">
                    <input id="postSearch" type="text" class="form-control" placeholder="Search by title, tags, or category..." oninput="filterPosts()">
                    <a href="{{ route('add_post') }}" class="btn btn-primary">Add Post</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle" id="postsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title & Description</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>Created</th>
                            <th style="width:170px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $i => $post)
                            @php
                                $categoryName = optional($post->category)->category_name ?? $post->category_id;
                                $tags = collect(explode(',', (string)$post->tags))
                                        ->map(fn($t) => trim($t))
                                        ->filter();
                            @endphp
                            <tr>
                                <td class="text-muted">{{ $i + 1 }}</td>
                                <td>
                                    <img class="thumb"
                                         src="{{ asset('uploads/posts/'.$post->image) }}"
                                         alt="{{ $post->title }}">
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $post->title }}</div>
                                    <div class="text-muted small truncate-2">{{ $post->description }}</div>
                                </td>
                                                                <td>
                                    <span class="badge text-bg-light border">
                                        {{ $post->category_post?->category_name ?? '—' }}
                                    </span>
                                </td>

                                <td>
                                    @if($tags->isEmpty())
                                        <span class="text-muted">—</span>
                                    @else
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($tags as $tag)
                                                <span class="badge badge-tag">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">{{ $post->created_at?->format('Y-m-d H:i') }}</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('edit_post', $post->id) }}" class="btn btn-sm btn-soft">Edit</a>
                                        <a href="{{ route('delete_post', $post->id) }}"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Delete this post?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No posts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
function filterPosts() {
    const q = document.getElementById('postSearch').value.toLowerCase();
    const rows = document.querySelectorAll('#postsTable tbody tr');
    rows.forEach(row => {
        const title = row.querySelector('td:nth-child(3) .fw-semibold')?.textContent.toLowerCase() || '';
        const desc = row.querySelector('td:nth-child(3) .text-muted')?.textContent.toLowerCase() || '';
        const category = row.querySelector('td:nth-child(4) .badge')?.textContent.toLowerCase() || '';
        const tags = Array.from(row.querySelectorAll('td:nth-child(5) .badge'))
                          .map(b => b.textContent.toLowerCase()).join(' ');
        const match = [title, desc, category, tags].some(txt => txt.includes(q));
        row.style.display = match ? '' : 'none';
    });
}
</script>

@endsection
