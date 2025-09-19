@extends('layouts.admin')
@section('content')

    <h1 class="mb-4 text-center fw-bold" style="font-family: 'Curlz MT';">
        📖 Books
    </h1>

    <div class="d-flex gap-2 mb-4">
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary glare-hover">
            ➕ Create Book
        </a>
        <a href="{{ route('books.all') }}" class="btn btn-success glare-hover">
            📚 Show All Books
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Year</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td class="fw-bold">{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $book->author->name ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $book->category->name ?? '-' }}
                                </span>
                            </td>
                            <td>{{ Str::limit($book->description, 25, '...') }}</td>
                            <td><span class="badge bg-light text-dark">{{ $book->published_year }}</span></td>
                            <td><strong class="text-success">${{ $book->price ?? '-' }}</strong></td>
                            <td>
                                @if($book->quantity > 0)
                                    <span class="badge bg-primary">{{ $book->quantity }}</span>
                                @else
                                    <span class="badge bg-danger">Out</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.books.edit', $book->id) }}"
                                   class="btn btn-warning btn-sm anim-border-pulse">✏️ Edit</a>
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                      class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm anim-colorPulse">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        /* Glare Hover Effect */
        .glare-hover {
            position: relative;
            overflow: hidden;
        }
        .glare-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: rgba(255, 255, 255, 0.5);
            transform: skewX(-25deg);
            transition: transform 0.7s ease-out, left 0.7s ease-out;
        }
        .glare-hover:hover::before {
            left: 125%;
            transform: skewX(-25deg) translateX(0);
        }

        /* Доп. стили для кнопок (optional) */
        .btn.glare-hover {
            color: #fff;
            position: relative;
        }

        @keyframes rainbow-text {
            0% { color: red; }
            20% { color: orange; }
            40% { color: yellow; }
            60% { color: green; }
            80% { color: blue; }
            100% { color: red; }
        }

        .anim-rainbow {
            animation: rainbow-text 2s linear infinite;
        }

        @keyframes borderPulse {
            0%, 100% { box-shadow: 0 0 2px 2px #000000; }
            50% { box-shadow: 0 0 10px 4px #0077cc; }
            10% { box-shadow: 0 0 10px 4px #e6ff00; }
            20% { box-shadow: 0 0 10px 4px #6dcc00; }
        }
        .anim-border-pulse {
            animation: borderPulse 1.5s infinite;
        }

        @keyframes colorPulse {
            0%, 100% { box-shadow: 0 0 2px 2px #000000; }
            50% { box-shadow: 0 0 20px  red; }
        }
        .anim-colorPulse {
            animation: colorPulse 0.8s infinite;
        }


        @keyframes leftPulse {
            5%, 70%, 70% { transform: translateX(0); }
            40% { transform: translateX(-100px); }
        }

        .anim-leftPulse {
            animation: leftPulse 2s ease infinite;
        }


        @keyframes rightPulse {
            5%, 70%, 70% { transform: translateX(0); }
            40% { transform: translateX(100px); }
            50% { transform: translateX(-100px); }
            40% { transform: translateY(100px); }
            50% { transform: translateY(-100px); }
        }

        .anim-rightPulse {
            animation: rightPulse 2s ease infinite;
        }

        @keyframes upPulse {
            0%, 5%, 70%, 100% { transform: translateY(0); }
            40% { transform: translateY(-66px); }
        }

        .anim-rainbow-upPulse {
            animation: rainbow-text 2s linear infinite, upPulse 2s ease-in-out infinite;
        }

        .element {
            border: 5px solid #2E9AFF;
        }

    </style>

@endsection


