@extends('layouts.admin')

@section('content')
    <h2>Редактировать выдачу книги</h2>

    <form action="{{ route('admin.borrowings.update', $borrowing->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">Пользователь</label>
            <select name="user_id" class="form-control" required>
                <option value="">Выберите пользователя</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $borrowing->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="book_id" class="form-label">Книга</label>
            <select name="book_id" class="form-control" required>
                <option value="">Выберите книгу</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ $borrowing->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="borrowed_at" class="form-label">Дата выдачи</label>
            <input type="date" name="borrowed_at" class="form-control"
                   value="{{ old('borrowed_at', $borrowing->borrowed_at ? \Carbon\Carbon::parse($borrowing->borrowed_at)->format('Y-m-d') : '') }}" required>
        </div>

        <div class="mb-3">
            <label for="returned_at" class="form-label">Срок возврата</label>
            <input type="date" name="returned_at" class="form-control"
                   value="{{ old('returned_at', $borrowing->returned_at ? \Carbon\Carbon::parse($borrowing->returned_at)->format('Y-m-d') : '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection

