<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book', 'user'])
            ->latest()
            ->paginate(10);
            
        return view('loans.index', compact('loans'));
    }

    public function create(Book $book)
    {
        return view('loans.create', compact('book'));
    }

    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'borrower_name' => 'required|string|max:255',
            'due_date' => 'required|date|after:today',
        ]);

        $loan = $book->loans()->create([
            'loan_date' => now(),
            'due_date' => $validated['due_date'],
            'borrower_name' => $validated['borrower_name'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('books.show', $book)
            ->with('success', 'Book loaned successfully!');
    }

    public function returnBook(Loan $loan)
    {
        $loan->update(['return_date' => now()]);
        return redirect()->back()
            ->with('success', 'Book returned successfully!');
    }

    public function edit(Loan $loan)
    {
        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'borrower_name' => 'required|string|max:255',
            'due_date' => 'required|date|after:today',
        ]);

        $loan->update($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Loan updated successfully!');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->back()
            ->with('success', 'Loan record deleted successfully!');
    }
}