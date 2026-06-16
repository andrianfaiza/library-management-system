<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Rack;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $books = Book::with('rack')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%")
                      ->orWhere('isbn', 'like', "%{$search}%");
            })
            ->get();

        $racks = Rack::all();

        $user = auth()->user();

    if ($user->hasRole('admin') || $user->hasRole('staff')) {
        return view('book.index', compact('books', 'racks', 'search'));
        }
        
        if ($user->hasRole('user')) {
        return view('user.index', compact('books', 'racks', 'search'));
        // return view('user.dashboard'); // dashboard user
    }

    }

    public function create()
    {
        $racks = Rack::all();
        return view('book.create', compact('racks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'isbn' => 'required|string',
            'title' => 'required|string',
            'publisher' => 'required|string',
            'publication_year' => 'required|string',
            'author' => 'required|string',
            'rack_id' => 'required|exists:racks,id',
            'quantity' => 'required|integer|min:0',
        ]);

        Book::create($validated);
        return redirect()->route('book.index')->with('success', 'Book added successfully');
    }

    public function edit(Book $book)
    {
        $racks = Rack::all();
        return view('book.edit', compact('book', 'racks'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'isbn' => 'required|string',
            'title' => 'required|string',
            'publisher' => 'required|string',
            'publication_year' => 'required|string',
            'author' => 'required|string',
            'rack_id' => 'required|exists:racks,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $book->update($validated);
        return redirect()->route('book.index')->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success', 'Book deleted successfully');
    }
}
