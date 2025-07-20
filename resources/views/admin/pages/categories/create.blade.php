@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Category</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
