@extends('backend.master') {{-- or your backend layout --}}
@section('main')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Category</h2>
        <a href="{{ route('read_category') }}" class="btn btn-secondary">Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('update_category', $category->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" name="category_name" id="category_name" 
                   class="form-control" 
                   value="{{ old('category_name', $category->category_name) }}" 
                   required>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>

@endsection
