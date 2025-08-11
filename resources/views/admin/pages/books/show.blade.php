@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">All Books</h1>
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/books/' . $book->cover) }}" class="card-img-top " alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text"><strong>Author:</strong> {{ $book->author->name ?? '-' }}</p>
                            <p class="card-text"><strong>Category:</strong> {{ $book->category->name ?? '-' }}</p>
                            <p class="card-text"><strong>Year:</strong> {{ $book->published_year }}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
