<div class="mb-3">
    <label>User</label>
    <select name="user_id" class="form-control">
        @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ isset($borrowing) && $borrowing->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Book</label>
    <select name="book_id" class="form-control">
        @foreach ($books as $book)
            <option value="{{ $book->id }}" {{ isset($borrowing) && $borrowing->book_id == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Borrowed At</label>
    <input type="date" name="borrowed_at" class="form-control" value="{{ old('borrowed_at', $borrowing->borrowed_at ?? '') }}">
</div>

<div class="mb-3">
    <label>Returned At</label>
    <input type="date" name="returned_at" class="form-control" value="{{ old('returned_at', $borrowing->returned_at ?? '') }}">
</div>

