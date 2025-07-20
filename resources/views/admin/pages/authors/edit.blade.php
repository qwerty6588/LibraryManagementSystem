@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Author</h1>
        <form action="{{ route('admin.authors.update', $author->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $author->name) }}">
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
