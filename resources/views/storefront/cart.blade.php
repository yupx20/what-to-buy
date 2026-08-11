@extends('layouts.storefront')

@section('title', 'Cart')

@section('content')
<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display font-extrabold text-3xl text-gray-900 mb-8">Your Cart</h1>

        @if(empty($cartItems))
            <div class="text-center py-20">
                <div class="w-24 h-24 rounded-3xl bg-lavender-50 flex items-center justify-center mx-auto mb-6">
                    <span class="text-5xl">🛒</span>
                </div>
                <h3 class="font-display font-bold text-xl text-gray-700 mb-2">Your cart is empty</h3>
                <p class="text-gray-500 mb-6">Looks like you haven't added any drinks yet.</p>
                <a href="{{ route('menu') }}" class="btn btn-primary">Browse Menu</a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $index => $item)
                        <div class="card-boba p-5" id="cart-item-{{ $index }}">
                            <div class="flex gap-4">
                                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-lavender-50 to-cream-100 flex items-center justify-center flex-shrink-0">
                                    @if(!empty($item['product_image']))
                                        <img src="{{ asset('storage/' . $item['product_image']) }}" alt="{{ $item['product_name'] }}" class="w-full h-full object-cover rounded-2xl">
                                    @else
                                        <span class="text-3xl">🧋</span>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="font-display font-bold text-sm text-gray-900">{{ $item['product_name'] }}</h3>
                                            @if(!empty($item['customizations']))
                                                <div class="flex flex-wrap gap-1 mt-1">
                                                    @foreach($item['customizations'] as $c)
                                                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-cream-100 text-gray-600">{{ $c['name'] }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <form method="POST" action="{{ route('cart.remove', $index) }}" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1 text-gray-400 hover:text-strawberry-500 transition-colors" aria-label="Remove item">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="flex items-center justify-between mt-3">
                                        <div class="flex items-center gap-2">
                                            <form method="POST" action="{{ route('cart.update', $index) }}" class="inline">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}">
                                                <button type="submit" class="w-7 h-7 rounded-full border border-cream-200 flex items-center justify-center text-gray-500 hover:border-lavender-400 text-xs">−</button>
                                            </form>
                                            <span class="font-display font-bold text-sm w-6 text-center">{{ $item['quantity'] }}</span>
                                            <form method="POST" action="{{ route('cart.update', $index) }}" class="inline">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ min(10, $item['quantity'] + 1) }}">
                                                <button type="submit" class="w-7 h-7 rounded-full border border-cream-200 flex items-center justify-center text-gray-500 hover:border-lavender-400 text-xs">+</button>
                                            </form>
                                        </div>
                                        <span class="font-display font-bold text-lavender-600">${{ number_format($item['total_price'], 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Order Summary --}}
                <div class="lg:col-span-1">
                    <div class="card-boba p-6 sticky top-24">
                        <h3 class="font-display font-bold text-lg text-gray-900 mb-4">Order Summary</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Subtotal ({{ $itemCount }} items)</span>
                                <span class="font-semibold">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Tax (8%)</span>
                                <span class="font-semibold">${{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="border-t border-cream-200 pt-3 flex justify-between">
                                <span class="font-display font-bold text-base">Total</span>
                                <span class="font-display font-bold text-xl text-lavender-600">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary w-full mt-6">
                            Proceed to Checkout
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('menu') }}" class="btn btn-ghost w-full mt-2 text-sm">Continue Shopping</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
