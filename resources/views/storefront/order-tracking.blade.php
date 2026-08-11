@extends('layouts.storefront')

@section('title', 'Track Order ' . $order->order_number)

@section('content')
<section class="py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Success Banner --}}
        @if(session('success'))
            <div class="bg-matcha-50 border border-matcha-200 rounded-2xl p-6 mb-8 text-center animate-slide-up">
                <span class="text-4xl block mb-3">🎉</span>
                <h2 class="font-display font-bold text-xl text-matcha-700 mb-1">Order Confirmed!</h2>
                <p class="text-sm text-matcha-600">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Order Header --}}
        <div class="text-center mb-10">
            <p class="text-sm text-gray-400 font-medium mb-1">Order Number</p>
            <h1 class="font-display font-extrabold text-2xl text-gray-900 mb-2">{{ $order->order_number }}</h1>
            <span class="badge status-{{ $order->status }} text-sm px-4 py-1.5">{{ $order->status_label }}</span>
        </div>

        {{-- Timeline --}}
        <div class="card-boba p-8 mb-8">
            <div class="timeline" id="order-timeline">
                @php
                    $steps = [
                        ['key' => 'placed', 'label' => 'Placed', 'icon' => '📝'],
                        ['key' => 'brewing', 'label' => 'Brewing', 'icon' => '🧋'],
                        ['key' => 'out_for_delivery', 'label' => $order->fulfillment_type === 'pickup' ? 'Ready' : 'On the Way', 'icon' => $order->fulfillment_type === 'pickup' ? '✅' : '🚗'],
                        ['key' => 'delivered', 'label' => 'Delivered', 'icon' => '🎉'],
                    ];
                    $currentStep = $order->status_step;
                @endphp

                <div class="timeline-progress" style="width: {{ $currentStep >= 3 ? 100 : ($currentStep / 3 * 100) }}%"></div>

                @foreach($steps as $index => $step)
                    <div class="timeline-step">
                        <div class="timeline-dot {{ $index < $currentStep ? 'completed' : ($index === $currentStep ? 'active' : '') }}">
                            @if($index < $currentStep)
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                            @elseif($index === $currentStep)
                                <span class="text-xs">{{ $step['icon'] }}</span>
                            @endif
                        </div>
                        <span class="timeline-label {{ $index <= $currentStep ? 'active' : '' }}">{{ $step['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Order Details --}}
        <div class="card-boba p-6 mb-6">
            <h3 class="font-display font-bold text-lg text-gray-900 mb-4">Order Details</h3>
            <div class="space-y-3">
                @foreach($order->items as $item)
                    <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-cream-100' : '' }}">
                        <div class="flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl bg-lavender-50 flex items-center justify-center text-lg">🧋</span>
                            <div>
                                <p class="font-semibold text-sm text-gray-900">{{ $item->product_name }}</p>
                                @if($item->customizations->isNotEmpty())
                                    <p class="text-xs text-gray-400">
                                        {{ $item->customizations->pluck('option_name')->join(', ') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-display font-bold text-sm text-gray-900">${{ number_format($item->total_price, 2) }}</p>
                            <p class="text-xs text-gray-400">Qty: {{ $item->quantity }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="border-t border-cream-200 mt-3 pt-3 space-y-1 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span>${{ number_format($order->subtotal, 2) }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Tax</span><span>${{ number_format($order->tax, 2) }}</span></div>
                @if($order->delivery_fee > 0)
                    <div class="flex justify-between"><span class="text-gray-500">Delivery Fee</span><span>${{ number_format($order->delivery_fee, 2) }}</span></div>
                @endif
                <div class="flex justify-between font-display font-bold text-base pt-2 border-t border-cream-200">
                    <span>Total</span>
                    <span class="text-lavender-600">${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="card-boba p-6">
            <h3 class="font-display font-bold text-lg text-gray-900 mb-4">Delivery Information</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-400 text-xs">Name</p>
                    <p class="font-semibold">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Fulfillment</p>
                    <p class="font-semibold capitalize">{{ str_replace('_', ' ', $order->fulfillment_type) }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Email</p>
                    <p class="font-semibold">{{ $order->customer_email }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Payment</p>
                    <p class="font-semibold capitalize">{{ str_replace('_', ' ', $order->payment_method) }} · {{ ucfirst($order->payment_status) }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Poll for status updates every 15 seconds
    if (document.getElementById('order-timeline')) {
        setInterval(async () => {
            try {
                const response = await fetch('{{ route("order.status", $order->order_number) }}');
                const data = await response.json();
                // Reload if status changed
                if (data.status !== '{{ $order->status }}') {
                    window.location.reload();
                }
            } catch (e) {}
        }, 15000);
    }
</script>
@endpush
