<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    BookController,
    CategoryController,
    DashboardController,
    LoanController,
    ReviewController,
    TagController,
    UserController
};

ROUTE::get('/', function () {
    return view('home');
})->name('home');
// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/reset-password', 'showResetForm')->name('password.reset');
    Route::post('/reset-password', 'resetPassword');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')->name('dashboard');

// Resource Routes with explicit methods
Route::resource('books', BookController::class)->except(['show']);
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');

Route::resource('categories', CategoryController::class)->except(['show']);
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::resource('tags', TagController::class)->except(['show']);
Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');

// Loans with proper nesting
Route::prefix('loans')->group(function () {
    Route::get('/', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/create/{book}', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/', [LoanController::class, 'store'])->name('loans.store');
    Route::post('/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
    Route::get('/{loan}/edit', [LoanController::class, 'edit'])->name('loans.edit');
    Route::put('/{loan}', [LoanController::class, 'update'])->name('loans.update');
    Route::delete('/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');
});

// Reviews
Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])
    ->middleware('auth')->name('reviews.store');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])
    ->middleware('auth')->name('reviews.update');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
    ->middleware('auth')->name('reviews.destroy');

// User Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'show'])->name('users.show');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('users.update');
});