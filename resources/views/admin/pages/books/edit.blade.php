@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit a book</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Errors during the update:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Name of the book</label>
                <input type="text" name="title" class="form-control"
                       value="{{ old('title', $book->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="author_id" class="form-label">Author</label>
                <select name="author_id" class="form-control" required>
                    <option value="">-- Select Author --</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}"
                            {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>



            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="published_year" class="form-label">Published Year</label>
                <input type="text" name="published_year" class="form-control"
                       value="{{ old('published_year', $book->published_year) }}"
                       required pattern="\d{4}" placeholder="YYYY">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" step="0.01" name="price" class="form-control"
                       value="{{ old('price', $book->price) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
