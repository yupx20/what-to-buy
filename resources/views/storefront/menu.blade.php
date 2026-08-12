@extends('layouts.storefront')

@section('title', 'Menu')
@section('meta_description', 'Browse our full menu of handcrafted boba and milk tea drinks. Customize and order online.')

@section('content')
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Page Header --}}
        <div class="text-center mb-10">
            <h1 class="font-display font-extrabold text-4xl text-gray-900 mb-3">Our Menu</h1>
            <p class="text-gray-500 max-w-md mx-auto">Handcrafted with premium ingredients. Pick your favorite and customize it your way.</p>
        </div>

        {{-- Category Tabs --}}
        <div class="flex flex-wrap justify-center gap-2 mb-10">
            <a href="{{ route('menu') }}"
               class="option-pill {{ !$activeCategory ? 'selected' : '' }}">
                All Drinks
            </a>
            @foreach($categories as $category)
                <a href="{{ route('menu', ['category' => $category->slug]) }}"
                   class="option-pill {{ $activeCategory === $category->slug ? 'selected' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        {{-- Products Grid --}}
        @if($products->isEmpty())
            <div class="text-center py-20">
                <div class="w-16 h-16 rounded-2xl bg-lavender-50 flex items-center justify-center mx-auto mb-4">
                    <x-icon name="boba" class="w-8 h-8 text-lavender-400" />
                </div>
                <h3 class="font-display font-bold text-xl text-gray-700 mb-2">No drinks found</h3>
                <p class="text-gray-500">Check back soon for new flavors!</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- Drink Customizer Modal --}}
@include('storefront.partials.customizer-modal')
@endsection

@push('scripts')
<script>
    // Pass customization options to JS
    window.customizationOptions = @json($customizationOptions);
</script>
@endpush
