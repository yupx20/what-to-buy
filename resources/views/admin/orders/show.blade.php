@extends('layouts.admin')

@section('page_title', 'Order ' . $order->order_number)

@section('content')
<div class="space-y-6">
    {{-- Back Link --}}
    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-lavender-600 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Back to Orders
    </a>

    {{-- Order Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-display font-bold text-xl text-gray-900">{{ $order->order_number }}</h2>
            <p class="text-sm text-gray-500">Placed {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="badge status-{{ $order->status }} text-sm px-4 py-1.5">{{ $order->status_label }}</span>
            @if($order->canAdvance())
                <form method="POST" action="{{ route('admin.orders.advance', $order) }}">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-primary btn-sm">
                        Advance to {{ \App\Models\Order::STATUS_PIPELINE[array_search($order->status, \App\Models\Order::STATUS_PIPELINE) + 1] ?? '' }} →
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Order Items --}}
        <div class="lg:col-span-2">
            <div class="card-admin">
                <div class="p-5 border-b border-gray-100">
                    <h3 class="font-display font-bold text-base text-gray-900">Order Items</h3>
                </div>
                <div class="divide-y divide-gray-50">
                    @foreach($order->items as $item)
                        <div class="p-5 flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-lavender-50 flex items-center justify-center flex-shrink-0">
                                <x-icon name="boba" class="w-6 h-6 text-lavender-400" />
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $item->product_name }}</p>
                                        @if($item->customizations->isNotEmpty())
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                @foreach($item->customizations as $c)
                                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-cream-100 text-gray-600">
                                                        {{ $c->option_name }}
                                                        @if($c->option_price > 0) (+${{ number_format($c->option_price, 2) }}) @endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900">${{ number_format($item->total_price, 2) }}</p>
                                        <p class="text-xs text-gray-400">{{ $item->quantity }} × ${{ number_format($item->unit_price, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="p-5 bg-gray-50/50 border-t border-gray-100 space-y-2 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500">Subtotal</span><span class="font-semibold">${{ number_format($order->subtotal, 2) }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Tax</span><span class="font-semibold">${{ number_format($order->tax, 2) }}</span></div>
                    @if($order->delivery_fee > 0)
                        <div class="flex justify-between"><span class="text-gray-500">Delivery Fee</span><span class="font-semibold">${{ number_format($order->delivery_fee, 2) }}</span></div>
                    @endif
                    <div class="flex justify-between pt-2 border-t border-gray-200 text-base font-display font-bold">
                        <span>Total</span>
                        <span class="text-lavender-600">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Customer & Payment Info --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="card-admin p-5">
                <h3 class="font-display font-bold text-base text-gray-900 mb-4">Customer</h3>
                <div class="space-y-3 text-sm">
                    <div><span class="text-gray-400 text-xs">Name</span><p class="font-semibold">{{ $order->customer_name }}</p></div>
                    <div><span class="text-gray-400 text-xs">Email</span><p class="font-semibold">{{ $order->customer_email }}</p></div>
                    @if($order->customer_phone)
                        <div><span class="text-gray-400 text-xs">Phone</span><p class="font-semibold">{{ $order->customer_phone }}</p></div>
                    @endif
                </div>
            </div>

            <div class="card-admin p-5">
                <h3 class="font-display font-bold text-base text-gray-900 mb-4">Fulfillment</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="text-gray-400 text-xs">Type</span>
                        <p class="font-semibold capitalize">
                            @if($order->fulfillment_type === 'delivery')
                                <x-icon name="car" class="w-4 h-4 inline" /> Delivery
                            @else
                                <x-icon name="store" class="w-4 h-4 inline" /> Store Pickup
                            @endif
                        </p>
                    </div>
                    @if($order->delivery_address)
                        <div><span class="text-gray-400 text-xs">Address</span><p class="font-semibold">{{ $order->delivery_address }}</p></div>
                    @endif
                    @if($order->pickup_time)
                        <div><span class="text-gray-400 text-xs">Pickup Time</span><p class="font-semibold">{{ $order->pickup_time->format('M d, Y h:i A') }}</p></div>
                    @endif
                </div>
            </div>

            <div class="card-admin p-5">
                <h3 class="font-display font-bold text-base text-gray-900 mb-4">Payment</h3>
                <div class="space-y-3 text-sm">
                    <div><span class="text-gray-400 text-xs">Method</span><p class="font-semibold capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p></div>
                    <div>
                        <span class="text-gray-400 text-xs">Status</span>
                        <p class="font-semibold">
                            <span class="inline-flex items-center gap-1">
                                @if($order->payment_status === 'paid')
                                    <span class="w-2 h-2 rounded-full bg-matcha-400"></span> Paid
                                @elseif($order->payment_status === 'pending')
                                    <span class="w-2 h-2 rounded-full bg-yellow-400"></span> Pending
                                @else
                                    <span class="w-2 h-2 rounded-full bg-strawberry-400"></span> Failed
                                @endif
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            @if($order->notes)
                <div class="card-admin p-5">
                    <h3 class="font-display font-bold text-base text-gray-900 mb-2">Notes</h3>
                    <p class="text-sm text-gray-600">{{ $order->notes }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
