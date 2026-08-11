@props(['testimony'])

<div class="card-boba p-6 animate-slide-up">
    <div class="flex items-start gap-4">
        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-lavender-200 to-strawberry-200 flex items-center justify-center flex-shrink-0">
            <span class="font-display font-bold text-sm text-lavender-700">{{ substr($testimony->customer_name, 0, 1) }}</span>
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-1">
                <h4 class="font-display font-bold text-sm text-gray-900">{{ $testimony->customer_name }}</h4>
                <span class="text-xs text-gray-400">{{ $testimony->created_at->diffForHumans() }}</span>
            </div>
            <x-star-rating :rating="$testimony->rating" size="sm" />
            <p class="mt-2 text-sm text-gray-600 leading-relaxed">{{ $testimony->review_text }}</p>
            @if($testimony->photo_path)
                <img src="{{ asset('storage/' . $testimony->photo_path) }}" alt="Review photo"
                     class="mt-3 rounded-xl w-full max-w-xs object-cover aspect-video">
            @endif
        </div>
    </div>
</div>
