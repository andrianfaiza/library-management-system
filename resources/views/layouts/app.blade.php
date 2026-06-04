<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="/dashboard">🏠 Dashboard</a></li>
            </ul>
            <ul>
                <li><a href="{{ route('book.index')}}">📚 Books</a></li>
                <li><a href="{{ route('rak.index')}}">🗄️ Shelves</a></li>
                <li><a href="{{ route('siswa.index')}}">👥 Students</a></li>
                <li><a href="{{ route('peminjaman.index')}}">📖 Book Loans</a></li>
                <li><a href="{{ route('pengembalian.index')}}">↩️ Returns</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="dashboard">
                <p>📚 Library Management System | Admin</p>
                <form method="POST" action="/logout" style="display: inline;">
                    @csrf
                    <button type="submit" class="out"><i class="fas fa-sign-out-alt mr-2"></i> Logout</button>
                </form>
            </div>
            <div class="data1">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>