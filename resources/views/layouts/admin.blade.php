<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>Library Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Flag Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css"/>

    <style>
        body {
            background: #f5f6fa;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        /* Glitch effect */
        .glitch {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 900;
            position: relative;
            user-select: none;
        }
        .glitch::after,
        .glitch::before {
            content: attr(data-text);
            position: absolute;
            left: 0;
            top: 0;
            color: #fff;
            background: transparent;
            overflow: hidden;
            clip-path: inset(0 0 0 0);
        }
        .glitch::after {
            left: 2px;
            text-shadow: -2px 0 red;
            animation: glitch-anim 1s infinite linear alternate-reverse;
        }
        .glitch::before {
            left: -2px;
            text-shadow: 2px 0 cyan;
            animation: glitch-anim 0.8s infinite linear alternate-reverse;
        }


        @keyframes glitch-anim {
            0% { clip-path: inset(10% 0 50% 0); }
            25% { clip-path: inset(40% 0 30% 0); }
            50% { clip-path: inset(20% 0 40% 0); }
            75% { clip-path: inset(35% 0 25% 0); }
            100% { clip-path: inset(30% 0 35% 0); }
        }

        /* Sidebar */
        .sidebar {
            background: #212529;
            min-height: 100vh;
            padding-top: 2rem;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            margin: 0.3rem 0;
            border-radius: 0.5rem;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #495057;
            color: #fff;
        }

        /* Content */
        .content-wrapper {
            padding: 2rem;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
        }

        footer {
            background: #212529;
            color: #adb5bd;
            text-align: center;
            padding: 1rem 0;
            margin-top: 3rem;
            border-top: 1px solid #343a40;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
        <a class="glitch mb-4 text-decoration-none" data-text="Library Admin" href="{{ route('admin.books.index') }}">
            Library Admin
        </a>

        <ul class="nav nav-pills flex-column mb-auto">
            <li><a class="nav-link" href="{{ route('admin.books.index') }}">📚 Books</a></li>
            <li><a class="nav-link" href="{{ route('admin.authors.index') }}">✍ Authors</a></li>
            <li><a class="nav-link" href="{{ route('admin.categories.index') }}">📂Categories</a></li>
            <li><a class="nav-link" href="{{ route('admin.borrowings.index') }}">📑 Borrowings</a></li>
            <li><a class="nav-link" href="{{ route('admin.users.index') }}">👤Users</a></li>
        </ul>

        <div class="mt-auto">
            @auth
                <div class="dropdown">
                    <a class="d-block text-white text-decoration-none dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown">
                        👤 {{ Auth::user()->name ?? 'User' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="userDropdown">
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            <div class="dropdown mt-3">
                <a class="d-block text-white text-decoration-none dropdown-toggle" href="#" id="langDropdown" data-bs-toggle="dropdown">
                    🌐 {{ strtoupper(app()->getLocale()) }}
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="langDropdown">
                    <li><a class="dropdown-item" href="?lang=en">English</a></li>
                    <li><a class="dropdown-item" href="?lang=uz">Oʻzbekcha</a></li>
                    <li><a class="dropdown-item" href="?lang=ru">Русский</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="content-wrapper flex-grow-1">
        @yield('content')

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
