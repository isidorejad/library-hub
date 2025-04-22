<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\Loan;
use App\Models\Category;
use App\Models\Tag;


class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'genre',
        'publication_date',
        'cover_image',
        'description',
    ];

    protected $dates = ['publication_date'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'book_tags');
    }
}