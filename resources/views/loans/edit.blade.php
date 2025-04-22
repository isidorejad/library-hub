@extends('layouts.app', ['title' => 'Edit Loan - ' . $loan->book->title])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center">
            <a href="{{ route('loans.index') }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Loan: {{ $loan->book->title }}</h1>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('loans.update', $loan) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="borrower_name" class="block text-sm font-medium text-gray-700">Borrower Name *</label>
                <input type="text" id="borrower_name" name="borrower_name" 
                       value="{{ old('borrower_name', $loan->borrower_name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                       required>
                @error('borrower_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date *</label>
                <input type="date" id="due_date" name="due_date" 
                       value="{{ old('due_date', $loan->due_date->format('Y-m-d')) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                       required>
                @error('due_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="mt-6 flex justify-end">
                <a href="{{ route('loans.index') }}" 
                   class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </a>
                <button type="submit" 
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update Loan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection