@extends('backend.master')
@section('main')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Categories</h2>
        <a href="{{ route('add_category') }}" class="btn btn-primary">Add Category</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th width="180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->created_at?->format('Y-m-d H:i') }}</td>
                    <td>{{ $category->updated_at?->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('edit_category', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('delete_category', $category->id) }}" 
                           onclick="return confirm('Are you sure you want to delete this category?')" 
                           class="btn btn-sm btn-danger">
                            Delete
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
