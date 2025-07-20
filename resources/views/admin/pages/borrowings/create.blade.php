@extends('layouts.admin')
@section('content')
    <h1>Create Borrowing</h1>
    @include('partials.alerts')
    <form action="{{ route('admin.borrowings.store') }}" method="POST">
        @csrf
        @include('admin.borrowings.form')
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
