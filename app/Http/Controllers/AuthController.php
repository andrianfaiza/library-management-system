<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Book;
use App\Models\Student;
use App\Models\Rack;
use App\Models\Loan;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalStudents = Student::count();
        $totalLoans = Loan::count();
        return view('dashboard.index', compact(
            'totalBooks',
            'totalStudents',
            'totalLoans'
        ));
    }

    public function userDashboard(Request $request)
    {
        $search = $request->search;

        $books = Book::with('rack')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            })->get();

        $racks = Rack::all();

        return view('user.index', compact('books', 'racks', 'search'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}