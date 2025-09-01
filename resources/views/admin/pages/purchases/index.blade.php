@extends('layouts.admin')
@section('content')
    <h1>Purchase</h1>
    <a href="{{ route('admin.purchases.create') }}" class="btn btn-primary mb-3">Create Purchase</a>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Book</th>
            <th>Quantity</th>
            <th>Total</th>
         {{--<th>Actions</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach ($purchases as $purchase )
            <tr>
                <td>{{ $purchase->id }}</td>
                <td>{{ $purchase->user->name ?? '-' }}</td>
                <td>{{ $purchase->book->title ?? '-' }}</td>
                <td>{{ $purchase->quantity }}</td>
                <td>{{ $purchase->total }}</td>
                <td>
                   {{-- <a href="{{ route('admin.purchases.edit', $purchase->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.purchases.destroy', $purchase->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

