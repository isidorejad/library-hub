@extends('layouts.app')

@section('title', $tag->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $tag->name }}</h1>
        </div>
        
        <div>
            <a href="{{ route('tags.edit', $tag) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
            <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg mb-8">
        <div class="px-6 py-5 border-b border-gray-200">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Books with this tag ({{ $tag->books->count() }})</h3>
        </div>
        @if($tag->books->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tag->books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($book->cover_image)
                                            <img class="h-10 w-10 rounded-sm object-cover" src="{{ $book->cover_image }}" alt="{{ $book->title }}">
                                        @else
                                            <div class="h-10 w-10 rounded-sm bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-book text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $book->title }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $book->author }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('books.show', $book) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="px-6 py-4 text-gray-500">
                No books found with this tag.
            </div>
        @endif
    </div>
</div>
@endsection