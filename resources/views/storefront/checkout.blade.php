@extends('layouts.storefront')

@section('title', 'Checkout')

@section('content')
<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display font-extrabold text-3xl text-gray-900 mb-2">Checkout</h1>
        <p class="text-gray-500 mb-8">Complete your order details below.</p>

        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Left: Form --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- Contact Info --}}
                    <div class="card-boba p-6">
                        <h2 class="font-display font-bold text-lg text-gray-900 mb-4">Contact Information</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="input-label" for="customer_name">Full Name *</label>
                                <input type="text" name="customer_name" id="customer_name" class="input @error('customer_name') input-error @enderror"
                                       value="{{ old('customer_name', $user->name ?? '') }}" required>
                                @error('customer_name') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="input-label" for="customer_phone">Phone Number</label>
                                <input type="tel" name="customer_phone" id="customer_phone" class="input @error('customer_phone') input-error @enderror"
                                       value="{{ old('customer_phone', $user->phone_number ?? '') }}">
                                @error('customer_phone') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label class="input-label" for="customer_email">Email Address *</label>
                                <input type="email" name="customer_email" id="customer_email" class="input @error('customer_email') input-error @enderror"
                                       value="{{ old('customer_email', $user->email ?? '') }}" required>
                                @error('customer_email') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Fulfillment Type --}}
                    <div class="card-boba p-6">
                        <h2 class="font-display font-bold text-lg text-gray-900 mb-4">Fulfillment</h2>
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <label class="option-pill text-center cursor-pointer has-[:checked]:border-lavender-500 has-[:checked]:bg-lavender-50">
                                <input type="radio" name="fulfillment_type" value="pickup" class="hidden" {{ old('fulfillment_type', 'pickup') === 'pickup' ? 'checked' : '' }}
                                       onchange="document.getElementById('pickup-fields').classList.remove('hidden'); document.getElementById('delivery-fields').classList.add('hidden');">
                                <span class="flex flex-col items-center gap-1 w-full">
                                    <x-icon name="store" class="w-6 h-6 text-lavender-500" />
                                    <span class="font-semibold text-sm">Store Pickup</span>
                                    <span class="text-xs text-gray-400">Free</span>
                                </span>
                            </label>
                            <label class="option-pill text-center cursor-pointer has-[:checked]:border-lavender-500 has-[:checked]:bg-lavender-50">
                                <input type="radio" name="fulfillment_type" value="delivery" class="hidden" {{ old('fulfillment_type') === 'delivery' ? 'checked' : '' }}
                                       onchange="document.getElementById('delivery-fields').classList.remove('hidden'); document.getElementById('pickup-fields').classList.add('hidden');">
                                <span class="flex flex-col items-center gap-1 w-full">
                                    <x-icon name="car" class="w-6 h-6 text-lavender-500" />
                                    <span class="font-semibold text-sm">Local Delivery</span>
                                    <span class="text-xs text-gray-400">$3.99</span>
                                </span>
                            </label>
                        </div>

                        <div id="pickup-fields" class="{{ old('fulfillment_type', 'pickup') !== 'pickup' ? 'hidden' : '' }}">
                            <label class="input-label" for="pickup_time">Preferred Pickup Time</label>
                            <input type="datetime-local" name="pickup_time" id="pickup_time" class="input"
                                   value="{{ old('pickup_time') }}" min="{{ now()->addMinutes(30)->format('Y-m-d\TH:i') }}">
                        </div>

                        <div id="delivery-fields" class="{{ old('fulfillment_type') !== 'delivery' ? 'hidden' : '' }}">
                            <label class="input-label" for="delivery_address">Delivery Address *</label>
                            <textarea name="delivery_address" id="delivery_address" rows="3" class="input @error('delivery_address') input-error @enderror"
                                      placeholder="Enter your full delivery address">{{ old('delivery_address', $user->address ?? '') }}</textarea>
                            @error('delivery_address') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="card-boba p-6">
                        <h2 class="font-display font-bold text-lg text-gray-900 mb-4">Payment Method</h2>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-3 rounded-xl border-2 border-cream-200 cursor-pointer has-[:checked]:border-lavender-500 has-[:checked]:bg-lavender-50 transition-all">
                                <input type="radio" name="payment_method" value="card" {{ old('payment_method', 'card') === 'card' ? 'checked' : '' }} class="hidden">
                                <span class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <x-icon name="card" class="w-5 h-5 text-blue-500" />
                                </span>
                                <div>
                                    <p class="font-semibold text-sm">Credit / Debit Card</p>
                                    <p class="text-xs text-gray-400">Visa, Mastercard, AMEX</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl border-2 border-cream-200 cursor-pointer has-[:checked]:border-lavender-500 has-[:checked]:bg-lavender-50 transition-all">
                                <input type="radio" name="payment_method" value="apple_pay" {{ old('payment_method') === 'apple_pay' ? 'checked' : '' }} class="hidden">
                                <span class="w-10 h-10 rounded-lg bg-gray-50 flex items-center justify-center">
                                    <x-icon name="apple-pay" class="w-5 h-5 text-gray-800" />
                                </span>
                                <div>
                                    <p class="font-semibold text-sm">Apple Pay</p>
                                    <p class="text-xs text-gray-400">Express checkout</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl border-2 border-cream-200 cursor-pointer has-[:checked]:border-lavender-500 has-[:checked]:bg-lavender-50 transition-all">
                                <input type="radio" name="payment_method" value="google_pay" {{ old('payment_method') === 'google_pay' ? 'checked' : '' }} class="hidden">
                                <span class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                                    <x-icon name="google-pay" class="w-5 h-5 text-green-600" />
                                </span>
                                <div>
                                    <p class="font-semibold text-sm">Google Pay</p>
                                    <p class="text-xs text-gray-400">Express checkout</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Notes --}}
                    <div class="card-boba p-6">
                        <label class="input-label" for="notes">Order Notes <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="notes" id="notes" rows="2" class="input" placeholder="Any special instructions...">{{ old('notes') }}</textarea>
                    </div>
                </div>

                {{-- Right: Summary --}}
                <div class="lg:col-span-1">
                    <div class="card-boba p-6 sticky top-24">
                        <h3 class="font-display font-bold text-lg text-gray-900 mb-4">Order Summary</h3>
                        <div class="space-y-3 mb-4">
                            @foreach($cartItems as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">{{ $item['product_name'] }} × {{ $item['quantity'] }}</span>
                                    <span class="font-semibold">${{ number_format($item['total_price'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-t border-cream-200 pt-3 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Subtotal</span>
                                <span class="font-semibold">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Tax (8%)</span>
                                <span class="font-semibold">${{ number_format($tax, 2) }}</span>
                            </div>
                            <div id="delivery-fee-row" class="flex justify-between {{ old('fulfillment_type') !== 'delivery' ? 'hidden' : '' }}">
                                <span class="text-gray-500">Delivery Fee</span>
                                <span class="font-semibold">$3.99</span>
                            </div>
                            <div class="border-t border-cream-200 pt-3 flex justify-between">
                                <span class="font-display font-bold text-base">Total</span>
                                <span class="font-display font-bold text-xl text-lavender-600" id="checkout-total">
                                    ${{ number_format($subtotal + $tax, 2) }}
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-full mt-6 btn-lg">
                            Place Order
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </button>
                        <p class="text-center text-xs text-gray-400 mt-3">By placing your order, you agree to our terms of service.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
