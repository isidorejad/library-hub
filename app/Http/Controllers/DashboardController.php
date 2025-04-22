<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Books
        $totalBooks = Book::count();
        
        // Total Categories
        $totalCategories = Category::count();
        
        // Active Loans (not returned)
        $activeLoans = Loan::whereNull('return_date')->count();
        
        // Overdue Loans (not returned and due date passed)
        $overdueLoans = Loan::whereNull('return_date')
                            ->where('due_date', '<', now())
                            ->count();
        
        // Recent Books (last 5 added)
        $recentBooks = Book::latest()
                          ->take(5)
                          ->get();
        
        // Recent Loans (last 5 loans)
        $recentLoans = Loan::with(['book'])
                          ->latest()
                          ->take(5)
                          ->get();
        
        return view('dashboard', [
            'totalBooks' => $totalBooks,
            'totalCategories' => $totalCategories,
            'activeLoans' => $activeLoans,
            'overdueLoans' => $overdueLoans,
            'recentBooks' => $recentBooks,
            'recentLoans' => $recentLoans,
        ]);
    }
}