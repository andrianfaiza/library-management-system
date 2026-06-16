<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Student;
use App\Models\User;
use App\Models\Book;
use App\Models\LoanDetail;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $students = Student::all();
        $users = User::all();

        $loans = Loan::with('student', 'user')
            ->when($search, function ($query, $search) {
                $query->where('loan_date', 'like', "%{$search}%")
                      ->orWhere('return_date', 'like', "%{$search}%")
                      ->orWhere('status', 'like', "%{$search}%")
                      ->orWhereHas('student', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%")
                            ->orWhere('nis', 'like', "%{$search}%");
                      });
            })->orderByRaw("FIELD(status, 'borrowed', 'partial', 'done')")
    ->get();

        return view('loan.index', compact('loans', 'students', 'users', 'search'));
    }

    public function create()
    {
        $students = Student::all();
        $users = User::all();
        return view('loan.create', compact('students', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'return_date' => 'required|date',
            'details' => 'required|array|min:1',
            'details.*.book_id' => 'required|exists:books,id',
            'details.*.quantity' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = auth()->id() ?? 2;

        DB::transaction(function () use ($validated) {
            $header = Loan::create([
                'student_id' => $validated['student_id'],
                'user_id' => $validated['user_id'],
                'loan_date' => now(),
                'return_date' => $validated['return_date'],
                'status' => 'borrowed',
            ]);

            foreach ($validated['details'] as $d) {
                LoanDetail::create([
                    'loan_id' => $header->id,
                    'book_id' => $d['book_id'],
                    'quantity' => $d['quantity'],
                    'status' => 'borrowed',
                ]);

                $book = Book::find($d['book_id']);
                if ($book) {
                    $book->decrement('quantity', $d['quantity']);
                }
            }

        });

        return redirect()->route('loan.index')->with('success', 'Loan added successfully');
    }

    public function edit(Loan $loan)
    {
        $students = Student::all();
        $users = User::all();
        return view('loan.edit', compact('loan', 'students', 'users'));
    }

    public function update(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'return_date' => 'required|date',
            'details' => 'required|array',
            'details.*.book_id' => 'required|exists:books,id',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.status' => 'nullable|in:borrowed,done',
        ]);

        $validated['user_id'] = auth()->id() ?? 2;

        DB::transaction(function () use ($validated, $loan) {
            $loan->update([
                'student_id' => $validated['student_id'],
                'user_id' => $validated['user_id'],
                'return_date' => $validated['return_date'],
            ]);

            $existing = $loan->details()->get()->keyBy('id');
            $incoming = collect($validated['details']);

            foreach ($incoming as $inc) {
                if (isset($inc['id']) && $existing->has($inc['id'])) {
                    $old = $existing->get($inc['id']);
                    $oldQuantity = $old->quantity;
                    $oldStatus = $old->status ?? 'borrowed';
                    $newStatus = $inc['status'] ?? 'borrowed';
                    $newQuantity = $inc['quantity'];

                    if ($oldStatus === 'borrowed' && $newStatus === 'borrowed') {
                        $diff = $newQuantity - $oldQuantity;
                        if ($diff > 0) {
                            $book = Book::find($inc['book_id']);
                            if ($book) $book->decrement('quantity', $diff);
                        } elseif ($diff < 0) {
                            $book = Book::find($inc['book_id']);
                            if ($book) $book->increment('quantity', abs($diff));
                        }
                    } elseif ($oldStatus === 'borrowed' && $newStatus === 'done') {
                        $book = Book::find($inc['book_id']);
                        if ($book) $book->increment('quantity', $oldQuantity);
                    } elseif ($oldStatus === 'done' && $newStatus === 'borrowed') {
                        $book = Book::find($inc['book_id']);
                        if ($book) $book->decrement('quantity', $newQuantity);
                    }

                    $old->update([
                        'book_id' => $inc['book_id'],
                        'quantity' => $newQuantity,
                        'status' => $newStatus,
                    ]);

                    $existing->forget($inc['id']);
                } else {
                    LoanDetail::create([
                        'loan_id' => $loan->id,
                        'book_id' => $inc['book_id'],
                        'quantity' => $inc['quantity'],
                        'status' => $inc['status'] ?? 'borrowed',
                    ]);

                    if (($inc['status'] ?? 'borrowed') === 'borrowed') {
                        $book = Book::find($inc['book_id']);
                        if ($book) $book->decrement('quantity', $inc['quantity']);
                    }
                }
            }

            foreach ($existing as $left) {
                if (($left->status ?? 'borrowed') === 'borrowed') {
                    $book = Book::find($left->book_id);
                    if ($book) $book->increment('quantity', $left->quantity);
                }
                $left->delete();
            }

            $total = $loan->details()->count();
            $done = $loan->details()->where('status', 'done')->count();

            $newStatus = 'borrowed';
            if ($done === 0) $newStatus = 'borrowed';
            elseif ($done === $total) $newStatus = 'done';
            else $newStatus = 'partial';

            $loan->update(['status' => $newStatus]);
        });

        return redirect()->route('loan.index')->with('success', 'Loan updated successfully');
    }

    public function destroy(Loan $loan)
    {
        DB::transaction(function () use ($loan) {
            foreach ($loan->details as $d) {
                if (($d->status ?? 'borrowed') === 'borrowed') {
                    $book = Book::find($d->book_id);
                    if ($book) $book->increment('quantity', $d->quantity);
                }
                $d->delete();
            }
            $loan->delete();
        });

        return redirect()->route('loan.index')->with('success', 'Loan deleted successfully');
    }
}
