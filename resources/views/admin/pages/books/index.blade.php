@extends('layouts.admin')
@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://phpstan.org/blog.c5a7da80.css">
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




    <h1 style="font-family: 'Curlz MT';  " class="">Books</h1>

    <div class="mb-3">
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary glare-hover" style="cursor: cell">
            Create Book
        </a>
        <a href="{{ route('books.all') }}" class="btn btn-success glare-hover">
            Show All Books
        </a>
    </div>
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

    <table class="table table-bordered ">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Description</th>
            <th>Published At</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author->name ?? '-' }}</td>
                <td>{{ $book->category->name ?? '-' }}</td>
                <td>{{ Str::limit($book->description, 15, '...') }}</td>
                <td style="font-family: 'Abril Fatface', serif;" >{{ $book->published_year }}</td>
                <td style="font-family: fantasy ">{{ $book->price ?? '-' }}</td>
                <td style="font-family: fantasy ">{{ $book->quantity ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm  anim-border-pulse ">Edit</a>
                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="cursor: no-drop" class="btn btn-danger btn-sm anim-colorPulse ">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

