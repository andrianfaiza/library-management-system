<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookReturn;
use App\Models\Loan;
use App\Models\User;
use App\Models\LoanDetail;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Carbon\Carbon;

class BookReturnController extends Controller
{
    public function index()
    {
        $returns = BookReturn::with('user', 'loan')->latest()->get();
        $loans   = Loan::with('student', 'user')->latest()->get();
        $users   = User::latest()->get();


        return view('book_return.index', compact('returns', 'loans', 'users'));
    }

     public function return(LoanDetail $detail)
    {
        if (($detail->status ?? 'borrowed') === 'done') {
            return redirect()->back()->with('info', 'Buku sudah done');
        }

        DB::transaction(function () use ($detail) {
            $book = Book::find($detail->book_id);
            if ($book) {
                $book->increment('quantity', $detail->quantity);
            }

            $detail->update(['status' => 'done']);

            $loan = Loan::find($detail->loan_id);

            // per-day fine (IDR) — change as needed or move to config
            $perDay = config('library.denda_per_hari', 1000);

            $fine = 0;
            if ($loan && $loan->tanggal_kembali) {
                $due = Carbon::parse($loan->tanggal_kembali)->startOfDay();
                $returned = Carbon::now()->startOfDay();
                if ($returned->gt($due)) {
                    $daysLate = $returned->diffInDays($due);
                    $fine = $daysLate * $perDay;
                }
            }

            BookReturn::create([
                'loan_id' => $detail->loan_id,
                'return_date' => now()->toDateString(),
                'fine' => $fine,
                'user_id' => auth()->id() ?? 1,
            ]);

            $loan = Loan::find($detail->loan_id);
            if ($loan) {
                $total = $loan->details()->count();
                $returned = $loan->details()->where('status', 'done')->count();

                $newStatus = 'borrowed';
                if ($returned === 0) $newStatus = 'borrowed';
                elseif ($returned === $total) $newStatus = 'done';
                else $newStatus = 'partial';

                $loan->update(['status' => $newStatus]);
            }
        });

        return redirect()->back()->with('success', 'Buku berhasil done');
    }

    // public function return(LoanDetail $loanDetail)
    // {
    //     if (($loanDetail->status ?? 'borrowed') === 'done') {
    //         return redirect()->back()->with('info', 'Book already returned');
    //     }

    //     DB::transaction(function () use ($loanDetail) {
    //         $book = Book::find($loanDetail->book_id);
    //         if ($book) {
    //             $book->increment('quantity', $loanDetail->quantity);
    //         }

    //         $loanDetail->update(['status' => 'done']);

    //         $loan = Loan::find($loanDetail->loan_id);

    //         $perDay = config('library.denda_per_hari', 1000);
    //         $fine = 0;

    //         if ($loan && $loan->return_date) {
    //             $due = Carbon::parse($loan->return_date)->startOfDay();
    //             $done = Carbon::now()->startOfDay();
    //             if ($done->gt($due)) {
    //                 $daysLate = $done->diffInDays($due);
    //                 $fine = $daysLate * $perDay;
    //             }
    //         }

    //         BookReturn::create([
    //             'loan_id' => $loanDetail->loan_id,
    //             'return_date' => now()->toDateString(),
    //             'fine' => $fine,
    //             'user_id' => auth()->id() ?? 1,
    //         ]);

    //         if ($loan) {
    //             $total = $loan->details()->count();
    //             $done = $loan->details()->where('status', 'done')->count();

    //             $newStatus = 'borrowed';
    //             if ($done === 0) $newStatus = 'borrowed';
    //             elseif ($done === $total) $newStatus = 'done';
    //             else $newStatus = 'partial';

    //             $loan->update(['status' => $newStatus]);
    //         }
    //     });

    //     return redirect()->back()->with('success', 'Book returned successfully');
    // }

}
