@extends('layouts.app')

@section('title', 'Loan Book')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Loan Book: {{ $book->title }}</h1>
        </div>

        <form action="{{ route('loans.store', $book) }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label for="borrower_name" class="block text-sm font-medium text-gray-700 mb-1">Borrower Name *</label>
                <input type="text" id="borrower_name" name="borrower_name" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600"
                       placeholder="Enter borrower's name">
                @error('borrower_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date *</label>
                <input type="date" id="due_date" name="due_date" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600"
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                @error('due_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end space-x-3">
                <a href="{{ route('books.show', $book) }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                    Loan Book
                </button>
            </div>
        </form>
    </div>
</div>
@endsection