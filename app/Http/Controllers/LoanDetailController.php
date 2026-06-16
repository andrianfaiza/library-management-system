<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanDetail;
use App\Models\Loan;
use App\Models\Book;
use Illuminate\View\View;

class LoanDetailController extends Controller
{
    public function index()
    {
        $query = LoanDetail::query();
        if (request()->has('loan_id')) {
            $query->where('loan_id', request('loan_id'));
        }

        $details = $query->get();
        $loans = Loan::all();
        $books = Book::all();

        return view('loan_detail.index', compact('details', 'loans', 'books'));
    }

    public function create()
    {
        $loans = Loan::all();
        $books = Book::all();
        return view('loan_detail.create', compact('loans', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        LoanDetail::create($validated);
        return redirect()->route('loan-detail.index')->with('success', 'Detail added successfully');
    }

    public function edit(LoanDetail $loanDetail)
    {
        $loans = Loan::all();
        $books = Book::all();
        return view('loan_detail.edit', compact('loanDetail', 'loans', 'books'));
    }

    public function update(Request $request, LoanDetail $loanDetail)
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $loanDetail->update($validated);
        return redirect()->route('loan-detail.index')->with('success', 'Detail updated successfully');
    }

    public function destroy(LoanDetail $loanDetail)
    {
        $loanDetail->delete();
        return redirect()->route('loan-detail.index')->with('success', 'Detail deleted successfully');
    }
}
