<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\LoanDetailController;

// // Route::get('/', function () {
// //     return view('welcome');
// // });

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->hasRole('staff')){
        return redirect()->route('staff.dashboard');
    }

    if (auth()->user()->hasRole('user')) {
        return redirect()->route('user.dashboard');
    }

    abort(403);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin|staff'])->group(function () {
    Route::get('books', [BookController::class, 'index'])->name('book.index');
    Route::get('racks', [RackController::class, 'index'])->name('rack.index');
    Route::get('returns', [BookReturnController::class, 'index'])->name('book-return.index');
    Route::get('details', [LoanDetailController::class, 'index'])->name('loan-detail.index');
    Route::get('students', [StudentController::class, 'index'])->name('student.index');
    Route::get('loans', [LoanController::class, 'index'])->name('loan.index');
    Route::resource('loan', LoanController::class);
    Route::post('/loan-detail/{detail}/return', [BookReturnController::class, 'return'])->name('loan-detail.return');
});

// Route admin
Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('book', BookController::class);
    Route::resource('book-return', BookReturnController::class);
    Route::resource('loan-detail', LoanDetailController::class);
    Route::resource('rack', RackController::class);
    Route::resource('student', StudentController::class);
});

// Route staff
Route::middleware(['auth', 'role:staff'])->group(function(){
    Route::get('staff/dashboard', [AuthController::class, 'dashboard'])->name('staff.dashboard');
});
    
// Route user 
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('user/dashboard', [AuthController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('user/books', [BookController::class, 'index'])->name('user.books'); 
});


require __DIR__.'/auth.php';
