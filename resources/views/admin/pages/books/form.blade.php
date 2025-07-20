<div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $book->title ?? '') }}">
</div>

<div class="mb-3">
    <label>Author</label>
    <select name="author_id" class="form-control">
        @foreach ($authors as $author)
            <option value="{{ $author->id }}" {{ isset($book) && $book->author_id == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ isset($book) && $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Published At</label>
    <input type="date" name="published_at" class="form-control" value="{{ old('published_at', $book->published_at ?? '') }}">
</div>
