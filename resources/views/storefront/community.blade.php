@extends('layouts.storefront')

@section('title', 'Community Reviews')

@section('content')
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="font-display font-extrabold text-4xl text-gray-900 mb-3">Community Reviews</h1>
            <p class="text-gray-500 max-w-md mx-auto mb-4">See what our boba lovers are saying.</p>
            <div class="flex items-center justify-center gap-4">
                <div class="flex items-center gap-2">
                    <x-star-rating :rating="$averageRating" size="lg" />
                    <span class="font-display font-bold text-2xl text-gray-900">{{ number_format($averageRating, 1) }}</span>
                </div>
                <span class="text-sm text-gray-400">{{ $totalReviews }} {{ Str::plural('review', $totalReviews) }}</span>
            </div>
        </div>

        {{-- Write Review Button --}}
        @auth
            <div class="text-center mb-10">
                <button onclick="document.getElementById('review-form').classList.toggle('hidden')" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Write a Review
                </button>
            </div>

            {{-- Review Form --}}
            <div id="review-form" class="hidden max-w-xl mx-auto mb-12">
                <div class="card-boba p-6">
                    <h3 class="font-display font-bold text-lg text-gray-900 mb-4">Share Your Experience</h3>
                    <form method="POST" action="{{ route('community.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="input-label">Rating *</label>
                                <div class="flex gap-2 mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" {{ old('rating') == $i ? 'checked' : '' }}>
                                            <span class="text-3xl text-cream-300 peer-checked:text-yellow-400 hover:text-yellow-300 transition-colors">★</span>
                                        </label>
                                    @endfor
                                </div>
                                @error('rating') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="input-label" for="review_text">Your Review *</label>
                                <textarea name="review_text" id="review_text" rows="4" class="input @error('review_text') input-error @enderror"
                                          placeholder="Tell us about your experience...">{{ old('review_text') }}</textarea>
                                @error('review_text') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="input-label" for="photo">Photo <span class="text-gray-400 font-normal">(optional, max 2MB)</span></label>
                                <input type="file" name="photo" id="photo" accept="image/*" class="input">
                                @error('photo') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-full">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="text-center mb-10">
                <a href="{{ route('login') }}" class="btn btn-secondary">Log in to write a review</a>
            </div>
        @endauth

        {{-- Reviews Grid --}}
        @if($testimonies->isEmpty())
            <div class="text-center py-16">
                <span class="text-6xl block mb-4">💬</span>
                <h3 class="font-display font-bold text-xl text-gray-700 mb-2">No reviews yet</h3>
                <p class="text-gray-500">Be the first to share your experience!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($testimonies as $testimony)
                    <x-testimony-card :testimony="$testimony" />
                @endforeach
            </div>
            <div class="mt-8">
                {{ $testimonies->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
