@extends('layouts.storefront')

@section('title', $product->name)
@section('meta_description', $product->description ?? "Order {$product->name} from What to Buy. Customize your perfect boba drink.")

@section('content')
<section class="py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            {{-- Product Image --}}
            <div class="relative">
                <div class="aspect-square rounded-boba bg-gradient-to-br from-lavender-50 to-cream-100 flex items-center justify-center overflow-hidden shadow-boba">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <x-icon name="boba" class="w-32 h-32 text-lavender-300" />
                    @endif
                </div>
                @if($product->badge_tag)
                    <span class="absolute top-6 left-6 badge badge-{{ str_replace('_', '-', $product->badge_tag) }} text-sm px-4 py-1.5">
                        {{ $product->badge_text }}
                    </span>
                @endif
            </div>

            {{-- Product Details --}}
            <div>
                @if($product->category)
                    <a href="{{ route('menu', ['category' => $product->category->slug]) }}"
                       class="text-xs font-semibold text-lavender-400 uppercase tracking-wider hover:text-lavender-600 transition-colors">
                        ← {{ $product->category->name }}
                    </a>
                @endif
                <h1 class="font-display font-extrabold text-3xl lg:text-4xl text-gray-900 mt-2 mb-3">{{ $product->name }}</h1>
                <p class="font-display font-bold text-3xl text-lavender-600 mb-4">{{ $product->formatted_price }}</p>

                @if($product->description)
                    <p class="text-gray-600 leading-relaxed mb-8">{{ $product->description }}</p>
                @endif

                @if($product->is_in_stock)
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-2.5 h-2.5 rounded-full bg-matcha-400"></span>
                        <span class="text-sm font-medium text-matcha-600">In Stock</span>
                    </div>

                    <button onclick="openCustomizer({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->base_price }})"
                            class="btn btn-primary btn-lg w-full md:w-auto">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Customize & Add to Cart
                    </button>
                @else
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-2.5 h-2.5 rounded-full bg-strawberry-400"></span>
                        <span class="text-sm font-medium text-strawberry-600">Currently Unavailable</span>
                    </div>
                    <button disabled class="btn btn-primary btn-lg opacity-50 cursor-not-allowed w-full md:w-auto">Sold Out</button>
                @endif
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->isNotEmpty())
            <div class="mt-20">
                <h2 class="font-display font-bold text-2xl text-gray-900 mb-8">You Might Also Like</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

@include('storefront.partials.customizer-modal')
@endsection

@push('scripts')
<script>window.customizationOptions = @json($customizationOptions);</script>
@endpush
