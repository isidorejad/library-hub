<div class="space-y-6">
    @foreach($reviews as $review)
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-start">
            <div>
                <div class="flex items-center mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                </div>
                @if($review->comment)
                    <p class="text-gray-700">{{ $review->comment }}</p>
                @endif
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
                            onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            </div>
            @endcan
        </div>
    </div>

    <!-- Edit Review Modal -->
    <dialog id="edit-review-{{ $review->id }}" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Review</h3>
        @include('reviews._form', ['review' => $review, 'book' => $review->book])
        <button onclick="document.getElementById('edit-review-{{ $review->id }}').close()" 
                class="mt-4 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
            Cancel
        </button>
    </dialog>
    @endforeach
</div>

@if($reviews->isEmpty())
<div class="bg-white shadow rounded-lg p-6 text-center text-gray-500">
    No reviews yet. Be the first to review!
</div>
@endif