@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add Author</h1>
        <form action="{{ route('admin.authors.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
