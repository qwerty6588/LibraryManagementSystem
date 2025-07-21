@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Add a new book</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Errors during saving:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.books.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Name of the book</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="author_name" class="form-label">Author</label>
                <input type="text" name="author_name" class="form-control" value="{{ old('author_name') }}" required>
            </div>

            <div class="mb-3">
                <label for="category_name" class="form-label">Category</label>
                <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="published_year" class="form-label">Published year</label>
                <input type="number" name="published_year" class="form-control" value="{{ old('published_year') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
