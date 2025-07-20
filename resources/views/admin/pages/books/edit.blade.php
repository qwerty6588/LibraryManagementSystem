@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Редактировать книгу</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ошибки при обновлении:</strong>
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
                <label for="title" class="form-label">Название книги</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Автор</label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Категория</label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $book->category) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="published_year" class="form-label">Год издания</label>
                <input type="number" name="published_year" class="form-control" value="{{ old('published_year', $book->published_year) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Обновить</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
