@extends('layouts.storefront')

@section('title', 'What to Buy')
@section('meta_description', 'Discover handcrafted boba and milk tea made with premium ingredients. Order online for pickup or delivery.')

@section('content')
{{-- Hero Section --}}
<section class="relative overflow-hidden bg-gradient-to-br from-lavender-50 via-cream-50 to-strawberry-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-slide-up">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-lavender-100 text-lavender-700 font-display font-semibold text-xs mb-6">
                    <span class="w-2 h-2 rounded-full bg-matcha-400 animate-pulse"></span>
                    Fresh & Handcrafted Daily
                </span>
                <h1 class="font-display font-extrabold text-5xl lg:text-7xl text-gray-900 leading-tight mb-6">
                    Sip Into
                    <span class="text-gradient">Something</span>
                    Wonderful
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-lg">
                    Premium boba & milk tea crafted with the finest ingredients. Customize your perfect drink and have it delivered or ready for pickup.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('menu') }}" class="btn btn-primary btn-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        Order Now
                    </a>
                    <a href="{{ route('menu') }}" class="btn btn-secondary btn-lg">
                        Browse Menu
                    </a>
                </div>
            </div>
            <div class="relative flex justify-center lg:justify-end">
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-br from-lavender-200/40 to-strawberry-200/40 rounded-[3rem] blur-2xl"></div>
                    <div class="relative w-72 h-72 lg:w-96 lg:h-96 rounded-[3rem] bg-gradient-to-br from-lavender-100 to-cream-100 flex items-center justify-center shadow-2xl">
                        <span class="text-9xl lg:text-[10rem] animate-float select-none">🧋</span>
                    </div>
                    {{-- Floating decorative elements --}}
                    <div class="absolute -top-6 -right-6 w-16 h-16 rounded-2xl bg-strawberry-100 flex items-center justify-center shadow-lg animate-float" style="animation-delay: 0.5s;">
                        <span class="text-2xl">🫧</span>
                    </div>
                    <div class="absolute -bottom-4 -left-4 w-14 h-14 rounded-2xl bg-matcha-100 flex items-center justify-center shadow-lg animate-float" style="animation-delay: 1s;">
                        <span class="text-2xl">🍵</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Wave Divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 120L60 105C120 90 240 60 360 52.5C480 45 600 60 720 67.5C840 75 960 75 1080 67.5C1200 60 1320 45 1380 37.5L1440 30V120H0Z" fill="var(--color-cream-50)"/>
        </svg>
    </div>
</section>

{{-- Featured Products --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block px-3 py-1 rounded-full bg-strawberry-50 text-strawberry-500 font-display font-bold text-xs uppercase tracking-wider mb-3">Fan Favorites</span>
            <h2 class="font-display font-extrabold text-3xl lg:text-4xl text-gray-900">Most Loved Drinks</h2>
            <p class="mt-3 text-gray-500 max-w-md mx-auto">Handpicked by our community. These are the drinks that keep everyone coming back.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('menu') }}" class="btn btn-secondary btn-lg">
                View Full Menu
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- How It Works --}}
<section class="py-20 bg-gradient-to-b from-cream-50 to-lavender-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="font-display font-extrabold text-3xl lg:text-4xl text-gray-900">How It Works</h2>
            <p class="mt-3 text-gray-500">Three easy steps to your perfect boba.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
            @php
                $steps = [
                    ['icon' => '🔍', 'title' => 'Choose Your Drink', 'desc' => 'Browse our curated menu of premium boba and milk tea creations.'],
                    ['icon' => '✨', 'title' => 'Customize It', 'desc' => 'Pick your ice level, sweetness, and up to 3 delicious toppings.'],
                    ['icon' => '🚀', 'title' => 'Get It Fast', 'desc' => 'Pick up in store or get it delivered right to your door.'],
                ];
            @endphp
            @foreach($steps as $index => $step)
                <div class="text-center">
                    <div class="w-20 h-20 rounded-3xl bg-white shadow-boba mx-auto mb-6 flex items-center justify-center">
                        <span class="text-4xl">{{ $step['icon'] }}</span>
                    </div>
                    <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-lavender-100 text-lavender-600 font-display font-bold text-sm mb-3">{{ $index + 1 }}</div>
                    <h3 class="font-display font-bold text-lg text-gray-900 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-sm text-gray-500 max-w-xs mx-auto">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-[2.5rem] bg-gradient-to-br from-lavender-500 to-lavender-700 p-12 lg:p-16 text-center text-white overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-strawberry-400 rounded-full blur-3xl"></div>
            </div>
            <div class="relative z-10">
                <h2 class="font-display font-extrabold text-3xl lg:text-4xl mb-4">Ready for a Treat?</h2>
                <p class="text-lavender-200 text-lg mb-8 max-w-md mx-auto">Your perfect boba is just a few taps away. Order now and sip into something wonderful.</p>
                <a href="{{ route('menu') }}" class="btn btn-accent btn-lg">
                    Start Your Order
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Drink Customizer Modal --}}
@include('storefront.partials.customizer-modal')
@endsection
