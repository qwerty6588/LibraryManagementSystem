@extends('layouts.app')

@section('content')
    <style>
        @keyframes bookFadeIn {
            0% { opacity: 0; transform: translateY(20px) scale(0.95); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .book-card {
            opacity: 0;
            animation: bookFadeIn 0.8s ease-in-out forwards;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }
        .book-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .book-img {
            height: 280px;
            object-fit: cover;
            border-bottom: 1px solid #f0f0f0;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }
        .card-text {
            font-size: 0.9rem;
            color: #555;
        }
        .price-tag {
            font-size: 1rem;
            font-weight: bold;
            color: #28a745;
        }
        .btn-custom {
            border-radius: 25px;
            font-weight: 500;
            transition: 0.3s;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
    </style>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">
                @if(auth()->check() && auth()->user()->email === 'admin@admin.com')
                    All Books
                @else
                    Buying books
                @endif
            </h1>

            @if(auth()->check() && auth()->user()->email === 'admin@admin.com')
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary btn-custom">
                    ← Back
                </a>
            @endif
        </div>

        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card book-card h-100">
                        @if($book->cover)
                            <img src="{{ asset('storage/books/' . $book->cover) }}"
                                 class="card-img-top book-img"
                                 alt="{{ $book->title }}">
                        @else
                            <img src="{{asset ('storage/'.$book->image)}}"
                                 class="card-img-top book-img"
                                 alt="No Image">
                        @endif

                        <div class="card-body">
                            <div>
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text"><strong>Author:</strong> {{ $book->author->name ?? '-' }}</p>
                                <p class="card-text"><strong>Category:</strong> {{ $book->category->name ?? '-' }}</p>
                                <p class="card-text"><strong>Year:</strong> {{ $book->published_year }}</p>
                                <p class="card-text price-tag">{{ number_format($book->price, 2) }} $</p>
                                <p class="card-text"><strong>Quantity:</strong> {{ $book->quantity ?? '-' }}</p>
                            </div>
                            <div class="mt-3">
                                @if(auth()->check() && auth()->user()->email === 'admin@admin.com')
                                    <a href="{{ route('admin.books.edit', $book->id) }}"
                                       class="btn btn-warning btn-sm w-100 btn-custom mb-2">✏️ Edit</a>
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="mb-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100 btn-custom">🗑️ Delete</button>
                                    </form>

                                    @if($book->quantity > 0)
                                        <a href="{{ route('purchase.create', $book->id) }}"
                                           class="btn btn-success w-100 btn-custom">💳 Buy Now</a>
                                    @else
                                        <p class="text-danger fw-bold text-center">Sold out</p>
                                    @endif
                                @else
                                    @if($book->quantity > 0)
                                        <a href="{{ route('purchase.create', $book->id) }}"
                                           class="btn btn-success w-100 btn-custom">💳 Buy Now</a>
                                    @else
                                        <p class="text-danger fw-bold text-center">Sold out</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
