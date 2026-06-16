<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - E-Library</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="brand">
                <i class="fas fa-book-open" style="color: #6366f1; font-size: 22px;"></i>
                <span class="brand-title">E-Library</span>
            </div>
            <ul>
                <li>
                    @if(auth()->user()->hasRole('admin'))
                    <a href="{{route('admin.dashboard')}}" class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                    @endif
                    @if(auth()->user()->hasRole('staff'))
                    <a href="{{route('staff.dashboard')}}" class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                    @endif
                        <i class="fas fa-chart-pie"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('book.index')}}" class="{{ Request::is('book*') ? 'active' : '' }}">
                        <i class="fas fa-book"></i> Books
                    </a>
                </li>
                <li>
                    <a href="{{ route('rack.index')}}" class="{{ Request::is('rack*') ? 'active' : '' }}">
                        <i class="fas fa-box-archive"></i> Shelves
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.index')}}" class="{{ Request::is('student*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i> Students
                    </a>
                </li>
                <li>
                    <a href="{{ route('loan.index')}}" class="{{ Request::is('loan*') || Request::is('loan-detail*') ? 'active' : '' }}">
                        <i class="fas fa-exchange-alt"></i> Book Loans
                    </a>
                </li>
                <li>
                    <a href="{{ route('book-return.index')}}" class="{{ Request::is('book-return*') ? 'active' : '' }}">
                        <i class="fas fa-history"></i> Returns
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="dashboard">
                <p><i class="fas fa-graduation-cap text-indigo-500"></i> Library Management System | 
                @role('admin')
                    Admin
                @endrole

                @role('staff')
                    Staff
                @endrole
                </p>
                <form method="POST" action="{{route('logout')}}" style="display: inline;">
                    @csrf
                    <button type="submit" class="out"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
            <div class="data1">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>