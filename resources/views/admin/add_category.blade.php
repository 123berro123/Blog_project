@extends('backend.master') {{-- or your backend layout --}}
@section('main')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Add Category</h2>
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

    <form action="{{ route('create_category') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter category name" required>
        </div>

        <button type="submit" class="btn btn-success">Save Category</button>
    </form>
</div>

@endsection
