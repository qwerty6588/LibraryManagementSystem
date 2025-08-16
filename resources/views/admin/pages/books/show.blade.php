@extends('layouts.admin')

@section('content')
    <style>
        @keyframes bookFadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .book-card {
            opacity: 0;
            animation: bookFadeIn 0.8s ease-in-out forwards;
        }

    </style>

    <div class="container">
        <h1 class="mb-4">All Books</h1>
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-3 mb-4 book-card">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/books/' . $book->cover) }}"
                             class="card-img-top"
                             alt="{{ $book->title }}">
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
