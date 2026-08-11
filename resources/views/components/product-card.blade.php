@props(['product'])

<div class="card-boba group cursor-pointer" data-product-id="{{ $product->id }}">
    {{-- Product Image --}}
    <div class="relative overflow-hidden aspect-square bg-gradient-to-br from-lavender-50 to-cream-100">
        @if($product->image_path)
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <span class="text-6xl">🧋</span>
            </div>
        @endif

        {{-- Badge --}}
        @if($product->badge_tag)
            <span class="absolute top-4 left-4 badge badge-{{ str_replace('_', '-', $product->badge_tag) }}">
                {{ $product->badge_text }}
            </span>
        @endif

        {{-- Quick Add Button --}}
        @if($product->is_in_stock)
            <button class="absolute bottom-4 right-4 w-10 h-10 rounded-full bg-lavender-500 text-white shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-lavender-600 flex items-center justify-center transform translate-y-2 group-hover:translate-y-0"
                    onclick="event.stopPropagation(); openCustomizer({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->base_price }})"
                    aria-label="Add {{ $product->name }} to cart">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
            </button>
        @endif
    </div>

    {{-- Product Info --}}
    <div class="p-5">
        @if($product->category)
            <p class="text-xs font-semibold text-lavender-400 uppercase tracking-wider mb-1">{{ $product->category->name }}</p>
        @endif
        <h3 class="font-display font-bold text-base text-gray-900 mb-1">{{ $product->name }}</h3>
        @if($product->description)
            <p class="text-xs text-gray-500 line-clamp-2 mb-3">{{ $product->description }}</p>
        @endif
        <div class="flex items-center justify-between">
            <span class="font-display font-bold text-lg text-lavender-600">{{ $product->formatted_price }}</span>
            @if(!$product->is_in_stock)
                <span class="badge badge-stock-out">Sold Out</span>
            @endif
        </div>
    </div>
</div>
