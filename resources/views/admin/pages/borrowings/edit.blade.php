@extends('layouts.admin')
@section('content')
    <h1>Edit Borrowing</h1>
    @include('partials.alerts')
    <form action="{{ route('admin.borrowings.update', $borrowing->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.borrowings.form')
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
