@extends('layouts.admin')
@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">


    <style>
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


    </style>


    <h1 style="font-family: 'Curlz MT';  " class="anim-rainbow-upPulse">Books</h1>

    <a href="{{ route('admin.books.create') }}" class="<!--anim-leftPulse--> btn btn-primary mb-3" style="cursor: cell">Create Book</a>

    <a href="{{ route('books.all') }}" class="btn btn-success mb-3 anim-rightPulse " >Show All Books</a>

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
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Description</th>
            <th >Published At</th>
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
                <td  style="font-family: 'Abril Fatface', serif;" >{{ $book->published_year }}</td>
                <td>


                    <a href="{{ route('admin.books.edit', $book->id) }}"
                       class="btn btn-warning btn-sm anim-border-pulse ">Edit</a>

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

