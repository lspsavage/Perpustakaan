<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Book Routes
    Route::get('/books', [BookController::class, 'bookspage'])->name('books');
    Route::get('/books/{id}/detail', [BookController::class, 'show'])->name('books.detail');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/store', [BookController::class, 'bookstore'])->name('books.store');
    Route::get('/books/{id}/update', [BookController::class, 'edit'])->name('books.edit'); 
    Route::put('/books/update/{id}', [BookController::class, 'update'])->name('books.update'); 
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy'); 

    // Member Routes
    Route::get('/members', [MemberController::class, 'memberpage'])->name('members');
    Route::get('/members/{id}/detail', [MemberController::class, 'showmember'])->name('members.detail');
    Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/members/store', [MemberController::class, 'store'])->name('members.store');
    Route::get('/members/{id}/update', [MemberController::class, 'edit'])->name('members.edit'); 
    Route::put('/members/update/{id}', [MemberController::class, 'update'])->name('members.update'); 
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy'); 
    Route::get('/members/search', [MemberController::class, 'search'])->name('members.search');

    // Loan Routes
    Route::get('/loans', [LoanController::class, 'loanpage'])->name('loans');
    Route::get('/loans/{book_id}/create', [LoanController::class, 'createLoan'])->name('loans.create'); 
    Route::post('/loans/store', [LoanController::class, 'storeLoan'])->name('loans.store'); 

    // Return Routes
    Route::get('/returns', [ReturnController::class, 'returnpage'])->name('returns');
    Route::get('/returns/{ID_loan}/create', [ReturnController::class, 'create'])->name('returns.create');
    Route::post('/returns/store', [ReturnController::class, 'store'])->name('returns.store');
    Route::get('/returns/{id}/detail', [ReturnController::class, 'showreturn'])->name('returns.detail');
});


require __DIR__.'/auth.php';
