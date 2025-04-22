<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book', 'borrower'])->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function create(Book $book)
    {
        $users = User::all();
        return view('loans.create', compact('book', 'users'));
    }

    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'borrower_name' => 'required|exists:users,id',
            'due_date' => 'required|date|after:today',
        ]);

        $loan = new Loan([
            'loan_date' => now(),
            'due_date' => $validated['due_date'],
            'borrower_name' => $validated['borrower_name'],
        ]);

        $book->loans()->save($loan);

        return redirect()->route('books.show', $book)->with('success', 'Book loaned successfully!');
    }

    public function returnBook(Loan $loan)
    {
        $loan->update(['return_date' => now()]);
        return redirect()->back()->with('success', 'Book returned successfully!');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->back()->with('success', 'Loan record deleted successfully!');
    }
}