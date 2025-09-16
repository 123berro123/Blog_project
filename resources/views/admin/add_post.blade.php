@extends('backend.master')
@section('main')

<style>
    .card-elevated { border: 0; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,.08); }
    .form-control, .form-select { border-radius: 10px; }
    .preview {
        width: 140px; height: 140px; object-fit: cover; border-radius: 12px; border: 1px solid #e5e7eb;
        display: none;
    }
    .hint { font-size: .9rem; color:#64748b; }
</style>

<div class="container py-4">
    <div class="card card-elevated">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Add Post</h3>
                <a href="{{ route('read_post') }}" class="btn btn-secondary">Back</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('create_post') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id')==$cat->id)>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Post title" required>
                </div>

                <div class="col-md-8">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="6" class="form-control" placeholder="Write the post description..." required>{{ old('description') }}</textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*" required>
                    <div class="hint mt-1">PNG/JPG up to 2MB</div>
                    <img id="preview" class="preview mt-2" alt="Preview">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Tags (comma separated)</label>
                    <input type="text" name="tags" class="form-control" value="{{ old('tags') }}" placeholder="e.g. drill, makita, power tools">
                </div>

                <div class="col-12 d-flex gap-2 pt-2">
                    <button class="btn btn-success" type="submit">Create Post</button>
                    <a href="{{ route('read_post') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const input = document.getElementById('imageInput');
const preview = document.getElementById('preview');
input?.addEventListener('change', (e) => {
    const file = e.target.files?.[0];
    if (!file) { preview.style.display='none'; return; }
    const reader = new FileReader();
    reader.onload = ev => { preview.src = ev.target.result; preview.style.display='block'; };
    reader.readAsDataURL(file);
});
</script>

@endsection
