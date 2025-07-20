@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Добавить новую книгу</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ошибки при сохранении:</strong>
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
                <label for="title" class="form-label">Название книги</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="author_name" class="form-label">Автор</label>
                <input type="text" name="author_name" class="form-control" value="{{ old('author_name') }}" required>
            </div>

            <div class="mb-3">
                <label for="category_name" class="form-label">Категория</label>
                <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="published_year" class="form-label">Год издания</label>
                <input type="number" name="published_year" class="form-control" value="{{ old('published_year') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
