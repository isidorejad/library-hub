@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <!-- Book Details -->
        <div class="flex flex-col md:flex-row">
            <!-- Cover Image -->
            <div class="md:w-1/3 mb-6 md:mb-0">
                @if($book->cover_image)
                    <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-full rounded-lg shadow">
                @else
                    <div class="bg-gray-200 w-full h-64 flex items-center justify-center rounded-lg">
                        <i class="fas fa-book text-6xl text-gray-400"></i>
                    </div>
                @endif
            </div>
            
            <!-- Book Info -->
            <div class="md:w-2/3 md:pl-8">
                <h1 class="text-3xl font-bold text-gray-900">{{ $book->title }}</h1>
                <p class="text-xl text-gray-600 mt-2">{{ $book->author }}</p>
                
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach($book->categories as $category)
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-900">Description</h3>
                    <p class="mt-2 text-gray-700">{{ $book->description ?? 'No description available' }}</p>
                </div>
                
                <!-- Loan Status -->
                <div class="mt-6">
                    @if($book->activeLoans->count() > 0)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Currently on loan to {{ $book->activeLoans->first()->borrower_name }}.
                                        Due back on {{ $book->activeLoans->first()->due_date->format('M d, Y') }}.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                            Available for loan
                        </span>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="mt-6 flex space-x-4">
            <a href="{{ route('books.edit', $book) }}" 
               class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                Edit Book
            </a>
            @if($book->activeLoans->count() === 0)
                <a href="{{ route('loans.create', $book) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Loan This Book
                </a>
            @endif
        </div>
        
        <!-- Reviews Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Reviews</h2>
            
            @auth
                <!-- Review Form -->
                <div class="bg-white shadow rounded-lg p-6 mb-8">
                    <form action="{{ route('reviews.store', $book) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" onclick="document.getElementById('rating').value = {{ $i }}" class="focus:outline-none">
                                        <svg class="h-8 w-8 {{ $i <= old('rating', 0) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </button>
                                @endfor
                                <input type="hidden" name="rating" id="rating" value="{{ old('rating', 0) }}">
                            </div>
                            @error('rating')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                            <textarea name="comment" id="comment" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('comment') }}</textarea>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            @endauth
            
            <!-- Reviews List -->
            @if($book->reviews->count() > 0)
                <div class="space-y-6">
                    @foreach($book->reviews as $review)
                        <div class="bg-white shadow rounded-lg p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @else
                                                <svg class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-gray-700">{{ $review->comment }}</p>
                                    <p class="text-sm text-gray-500 mt-2">
                                        Reviewed by {{ $review->user->username }} on {{ $review->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                
                                @can('update', $review)
                                    <div class="flex space-x-2">
                                        <button onclick="document.getElementById('edit-review-{{ $review->id }}').showModal()" 
                                                class="text-indigo-600 hover:text-indigo-900">
                                            Edit
                                        </button>
                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Are you sure you want to delete this review?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No reviews yet. Be the first to review!</p>
            @endif
        </div>
    </div>
</div>

<!-- Edit Review Modal -->
@foreach($book->reviews as $review)
    @can('update', $review)
        <dialog id="edit-review-{{ $review->id }}" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
            <form action="{{ route('reviews.update', $review) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" onclick="document.getElementById('edit-rating-{{ $review->id }}').value = {{ $i }}" class="focus:outline-none">
                                <svg class="h-8 w-8 {{ $i <= old('rating', $review->rating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </button>
                        @endfor
                        <input type="hidden" name="rating" id="edit-rating-{{ $review->id }}" value="{{ old('rating', $review->rating) }}">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="edit-comment-{{ $review->id }}" class="block text-sm font-medium text-gray-700 mb-2">Comment</label>
                    <textarea name="comment" id="edit-comment-{{ $review->id }}" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('comment', $review->comment) }}</textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="document.getElementById('edit-review-{{ $review->id }}').close()" 
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Update Review
                    </button>
                </div>
            </form>
        </dialog>
    @endcan
@endforeach

@endsection