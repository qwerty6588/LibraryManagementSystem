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

        <form action="{{ route('admin.books.update', $book->id) }}"
              method="POST" enctype="multipart/form-data">

        @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name of the book</label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="title[uz]" class="form-control mb-2"
                               placeholder="Название (UZ)"
                               value="{{ old('title.uz', $book->getTranslation('title', 'uz')) }}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="title[ru]" class="form-control mb-2"
                               placeholder="Название (RU)"
                               value="{{ old('title.ru', $book->getTranslation('title', 'ru')) }}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="title[en]" class="form-control mb-2"
                               placeholder="Название (EN)"
                               value="{{ old('title.en', $book->getTranslation('title', 'en')) }}">
                    </div>
                </div>
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
                <label class="form-label">Description</label>
                <div class="row">
                    <div class="col-md-4">
            <textarea name="description[uz]" class="form-control mb-2" rows="3"
                      placeholder="Описание (UZ)">{{ old('description.uz', $book->getTranslation('description', 'uz')) }}</textarea>
                    </div>
                    <div class="col-md-4">
            <textarea name="description[ru]" class="form-control mb-2" rows="3"
                      placeholder="Описание (RU)">{{ old('description.ru', $book->getTranslation('description', 'ru')) }}</textarea>
                    </div>
                    <div class="col-md-4">
            <textarea name="description[en]" class="form-control mb-2" rows="3"
                      placeholder="Описание (EN)">{{ old('description.en', $book->getTranslation('description', 'en')) }}</textarea>
                    </div>
                </div>
            </div>


            <div class="mb-3">
                <label for="published_year" class="form-label">Published Year</label>
                <input type="text" name="published_year" class="form-control"
                       value="{{ old('published_year', $book->published_year) }}"
                       required pattern="\d{4}" placeholder="YYYY">
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control"
                       value="{{ old('quantity', $book->quantity) }}" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" step="0.01" name="price" class="form-control"
                       value="{{ old('price', $book->price) }}" required>
            </div>


            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}"
                         class="img-fluid mt-2 rounded"
                         style="max-height:180px">
                @endif
            </div>


            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
