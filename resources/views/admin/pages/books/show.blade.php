@extends('layouts.app')

@section('content')
    <style>
        @keyframes bookFadeIn {
            0% { opacity: 0; transform: translateY(20px) scale(0.95); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .book-card { opacity: 0; animation: bookFadeIn 0.8s ease-in-out forwards; }
    </style>

    <div class="container">
        <h1 class="mb-4">All Books</h1>
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-3 mb-4 book-card">
                    <div class="card h-100 shadow-sm">
                        @if($book->cover)
                            <img src="{{ asset('storage/books/' . $book->cover) }}"
                                 class="card-img-top"
                                 alt="{{ $book->title }}">
                        @else
                            <img src="https://via.placeholder.com/200x300"
                                 class="card-img-top"
                                 alt="No Image">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text mb-1"><strong>Author:</strong> {{ $book->author->name ?? '-' }}</p>
                            <p class="card-text mb-1"><strong>Category:</strong> {{ $book->category->name ?? '-' }}</p>
                            <p class="card-text mb-1"><strong>Year:</strong> {{ $book->published_year }}</p>
                            <p class="card-text mb-3"><strong>Price:</strong>{{ number_format($book->price, 2) }} $ </p>
                            <p class="card-text mb-3"><strong>Quantity:</strong>{{$book->quantity ?? '-'}}</p>

                            <a href="{{ route('purchase.create', $book->id) }}" class="btn btn-success w-100">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">Buy Now</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
