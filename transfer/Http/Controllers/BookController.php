<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['categories', 'tags'])->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('books.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|unique:books',
            'genre' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'cover_image' => 'nullable|url',
            'description' => 'nullable|string',
            'categories' => 'nullable|array',
            'tags' => 'nullable|array',
        ]);

        $book = Book::create($validated);

        if ($request->has('categories')) {
            $book->categories()->sync($request->categories);
        }

        if ($request->has('tags')) {
            $book->tags()->sync($request->tags);
        }

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function show(Book $book)
    {
        $book->load(['categories', 'tags', 'reviews.user', 'loans.borrower']);
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $book->load(['categories', 'tags']);
        return view('books.edit', compact('book', 'categories', 'tags'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|unique:books,isbn,' . $book->id,
            'genre' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'cover_image' => 'nullable|url',
            'description' => 'nullable|string',
            'categories' => 'nullable|array',
            'tags' => 'nullable|array',
        ]);

        $book->update($validated);

        $book->categories()->sync($request->categories ?? []);
        $book->tags()->sync($request->tags ?? []);

        return redirect()->route('books.show', $book)->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}