<div class="bg-white shadow rounded-lg p-6">
    <form action="{{ route('reviews.store', $book) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
            <div class="flex" id="rating-stars">
                @for($i = 1; $i <= 5; $i++)
                    <button type="button" 
                            class="focus:outline-none star-rating"
                            onclick="setRating({{ $i }})"
                            aria-label="Rate {{ $i }} out of 5">
                        <svg class="h-8 w-8 {{ $i <= old('rating', 0) ? 'text-yellow-400' : 'text-gray-300' }}" 
                             fill="currentColor" viewBox="0 0 20 20"
                             data-rating="{{ $i }}">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </button>
                @endfor
                <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', 0) }}">
            </div>
            @error('rating')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
            <textarea name="comment" id="comment" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                      >{{ old('comment') }}</textarea>
            @error('comment')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" 
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit Review
            </button>
        </div>
    </form>
</div>
        <!-- Rest of your form remains the same -->
    </form>
</div>

@push('scripts')
<script>
    function setRating(rating) {
        // Update the hidden input value
        document.getElementById('rating-input').value = rating;
        
        // Update star colors
        const stars = document.querySelectorAll('#rating-stars svg');
        stars.forEach((star) => {
            const starRating = parseInt(star.getAttribute('data-rating'));
            if (starRating <= rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }

    // Initialize with any existing rating
    document.addEventListener('DOMContentLoaded', function() {
        const currentRating = parseInt(document.getElementById('rating-input').value);
        if (currentRating > 0) {
            setRating(currentRating);
        }

        // Add hover effects
        const stars = document.querySelectorAll('.star-rating');
        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const rating = parseInt(this.querySelector('svg').getAttribute('data-rating'));
                highlightStars(rating);
            });

            star.addEventListener('mouseout', function() {
                const currentRating = parseInt(document.getElementById('rating-input').value);
                highlightStars(currentRating);
            });
        });
    });

    function highlightStars(rating) {
        const stars = document.querySelectorAll('#rating-stars svg');
        stars.forEach((star) => {
            const starRating = parseInt(star.getAttribute('data-rating'));
            star.classList.toggle('text-yellow-400', starRating <= rating);
            star.classList.toggle('text-gray-300', starRating > rating);
        });
    }
</script>
@endpush

