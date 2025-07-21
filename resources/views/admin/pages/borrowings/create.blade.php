@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Создать заимствование книги</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ошибки:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.borrowings.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">Пользователь</label>
                <select name="user_id" class="form-select" required>
                    <option value="">....</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="book_id" class="form-label">Книга</label>
                <select name="book_id" class="form-select" required>
                    <option value="">.....</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                            {{ $book->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="borrowed_at" class="form-label">Дата заимствования</label>
                <input type="date" name="borrowed_at" class="form-control" value="{{ old('borrowed_at', now()->format('Y-m-d')) }}" required>
            </div>

            <div class="mb-3">
                <label for="returned_at" class="form-label">Дата возврата</label>
                <input type="date" name="returned_at" class="form-control" value="{{ old('returned_at') }}">
            </div>

            <button type="submit" class="btn btn-success">Создать</button>
            <a href="{{ route('admin.borrowings.index') }}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
@endsection
