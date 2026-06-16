<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - E-Library</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .brand-title {
            font-size: 18px;
            font-weight: 800;
            background: linear-gradient(to right, #a5b4fc, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.03em;
        }

        .data2 {
            padding: 40px;
            width: 100%;
            flex: 1;
            min-height: calc(100vh - 70px);
            margin-top: 3%;
        }
        .data2 h2 {
            font-size: 28px;
            font-weight: 800;
            color: var(--dark-bg);
            letter-spacing: -0.03em;
            position: relative;
        }
        .data2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }
        .data2 table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        .data2 table thead {
            background-color: #f8fafc;
            border-bottom: 2px solid var(--border-color);
        }

        .data2 table thead tr th,
        .data2 table thead tr td {
            padding: 16px 20px;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: none;
            border-right: none;
        }

        .data2 table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .data2 table tbody tr:last-child {
            border-bottom: none;
        }

        .data2 table tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.02);
        }

        .data2 table td {
            padding: 16px 20px;
            font-size: 14px;
            color: var(--text-main);
            vertical-align: middle;
            border: none;
        }
        .data2 table tbody tr:nth-child(even) {
            background-color: #fcfdfe;
        }
        @media (max-width: 1024px) {
            .brand-title {
                font-size: 16px;
            }
        }
        @media (max-width: 768px) {
            .brand-title {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard" style="width: 100%">
                <div class="brand">
                    <i class="fas fa-book-open" style="color: #6366f1; font-size: 22px;"></i>
                    <span class="brand-title">E-Library</span>
                </div>
                <form method="POST" action="{{route('logout')}}" style="display: inline;">
                    @csrf
                    <button type="submit" class="out"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        <div class="data2">
            <div class="header">
                    <h2>Book List</h2>
                </div>
                <div class="search-group">
                    <form method="GET" action="{{route('user.books')}}">
                        <input type="text" name="search" class="search"  placeholder="Search" value="{{ request('search') }}">
                        <button type="submit" class="btn-search">🔍 Search</button>
                    </form>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>ISBN</td>
                                <td>Title</td>
                                <td>Publisher</td>
                                <td>Publication Year</td>
                                <td>Author</td>
                                <td>Shelf Name</td>
                                <td>Quantity</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$book->isbn}}</td>
                                        <td>{{$book->title}}</td>
                                        <td>{{$book->publisher}}</td>
                                        <td>{{$book->publication_year}}</td>
                                        <td>{{$book->author}}</td>
                                        <td>{{$book->rack->name ?? $book->rack_id}}</td>
                                        <td>{{$book->quantity}}</td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>