<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\User;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'borrower_name',
        'loan_date',
        'due_date',
        'return_date',
    ];

    protected $dates = [
        'loan_date',
        'due_date',
        'return_date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_name');
    }
}