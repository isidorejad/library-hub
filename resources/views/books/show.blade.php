@extends('layouts.app', ['title' => 'Add New Book'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Add New Book</h1>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required>
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700">Author *</label>
                        <input type="text" id="author" name="author" value="{{ old('author') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required>
                        @error('author')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                        <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('isbn')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                        <input type="text" id="genre" name="genre" value="{{ old('genre') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('genre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <label for="publication_date" class="block text-sm font-medium text-gray-700">Publication Date</label>
                        <input type="date" id="publication_date" name="publication_date" value="{{ old('publication_date') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('publication_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cover_image" class="block text-sm font-medium text-gray-700">Cover Image URL</label>
                        <input type="url" id="cover_image" name="cover_image" value="{{ old('cover_image') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('cover_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="mt-6 flex justify-end">
                <a href="{{ route('books.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </a>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Book
                </button>
            </div>
        </form>
    </div>
    {{-- Reviews Section --}}
<div class="mt-12">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Reviews</h2>

    {{-- Reviews List --}}
    @include('reviews._list', ['reviews' => $book->reviews])

    {{-- Add Review Form (only for authenticated users) --}}
    @auth
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Add Your Review</h3>
            @include('reviews._form', ['book' => $book])
        </div>
    @else
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mt-6">
            <p class="text-blue-700">Please <a href="{{ route('login') }}" class="text-blue-600 underline">login</a> to leave a review.</p>
        </div>
    @endauth
</div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize select2 for multiple select
    document.addEventListener('DOMContentLoaded', function() {
        new MultiSelectTag('categories')
        new MultiSelectTag('tags')
    });
</script>
@endpush
