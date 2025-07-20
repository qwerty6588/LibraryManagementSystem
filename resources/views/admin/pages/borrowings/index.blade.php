@extends('layouts.admin')
@section('content')
    <h1>Borrowings</h1>
    <a href="{{ route('admin.borrowings.create') }}" class="btn btn-primary mb-3">Create Borrowing</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Book</th>
            <th>Borrowed At</th>
            <th>Returned At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($borrowings as $borrowing)
            <tr>
                <td>{{ $borrowing->id }}</td>
                <td>{{ $borrowing->user->name ?? '-' }}</td>
                <td>{{ $borrowing->book->title ?? '-' }}</td>
                <td>{{ $borrowing->borrowed_at }}</td>
                <td>{{ $borrowing->returned_at ?? 'Not Returned' }}</td>
                <td>
                    <a href="{{ route('admin.borrowings.edit', $borrowing->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.borrowings.destroy', $borrowing->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

