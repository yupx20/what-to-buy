@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- KPI Metrics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <x-stat-card
            label="Total Revenue"
            value="${{ number_format($metrics['total_revenue'], 2) }}"
            color="lavender"
            :icon="'<svg class=&quot;w-6 h-6 text-lavender-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z&quot;/></svg>'"
        />
        <x-stat-card
            label="Active Orders"
            value="{{ $metrics['active_orders'] }}"
            color="strawberry"
            :icon="'<svg class=&quot;w-6 h-6 text-strawberry-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2&quot;/></svg>'"
        />
        <x-stat-card
            label="Low Stock Items"
            value="{{ $metrics['low_stock_items'] }}"
            color="matcha"
            :icon="'<svg class=&quot;w-6 h-6 text-matcha-500&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;2&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; d=&quot;M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4&quot;/></svg>'"
        />
        <x-stat-card
            label="Avg. Rating"
            value="{{ number_format($metrics['avg_rating'], 1) }} ★"
            color="lavender"
            :icon="'<svg class=&quot;w-6 h-6 text-yellow-500&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 24 24&quot;><path d=&quot;M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2z&quot;/></svg>'"
        />
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        {{-- Recent Orders --}}
        <div class="xl:col-span-2">
            <div class="card-admin">
                <div class="flex items-center justify-between p-5 border-b border-gray-100">
                    <h2 class="font-display font-bold text-base text-gray-900">Recent Orders</h2>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm text-lavender-600 font-semibold hover:text-lavender-700">View All →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100">
                                <th class="px-5 py-3">Order</th>
                                <th class="px-5 py-3">Customer</th>
                                <th class="px-5 py-3">Items</th>
                                <th class="px-5 py-3">Total</th>
                                <th class="px-5 py-3">Status</th>
                                <th class="px-5 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-5 py-3">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="font-mono text-xs font-semibold text-lavender-600 hover:text-lavender-700">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td class="px-5 py-3 text-gray-700">{{ $order->customer_name }}</td>
                                    <td class="px-5 py-3 text-gray-500">{{ $order->items->count() }} items</td>
                                    <td class="px-5 py-3 font-semibold text-gray-900">{{ $order->formatted_total }}</td>
                                    <td class="px-5 py-3">
                                        <span class="badge status-{{ $order->status }}">{{ $order->status_label }}</span>
                                    </td>
                                    <td class="px-5 py-3">
                                        @if($order->canAdvance())
                                            <form method="POST" action="{{ route('admin.orders.advance', $order) }}" class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-primary">Advance</button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-400">Done</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-10 text-center text-gray-400">No orders yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Activity Feed --}}
        <div class="xl:col-span-1">
            <div class="card-admin">
                <div class="flex items-center justify-between p-5 border-b border-gray-100">
                    <h2 class="font-display font-bold text-base text-gray-900">Activity</h2>
                    <a href="{{ route('admin.activity') }}" class="text-sm text-lavender-600 font-semibold hover:text-lavender-700">View All →</a>
                </div>
                <div class="p-5 space-y-4 max-h-96 overflow-y-auto">
                    @forelse($recentActivity as $log)
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-lg flex-shrink-0 flex items-center justify-center text-sm
                                {{ $log->type === 'order' ? 'bg-lavender-50 text-lavender-600' : ($log->type === 'stock' ? 'bg-amber-50 text-amber-600' : 'bg-gray-50 text-gray-600') }}">
                                {{ $log->type === 'order' ? '📋' : ($log->type === 'stock' ? '📦' : '⚙️') }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $log->title }}</p>
                                <p class="text-xs text-gray-500 line-clamp-2">{{ $log->message }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $log->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 text-center py-8">No activity yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Today's Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="card-admin p-5">
            <p class="text-sm text-gray-500 mb-1">Today's Orders</p>
            <p class="font-display font-bold text-3xl text-gray-900">{{ $metrics['today_orders'] }}</p>
        </div>
        <div class="card-admin p-5">
            <p class="text-sm text-gray-500 mb-1">Today's Revenue</p>
            <p class="font-display font-bold text-3xl text-gray-900">${{ number_format($metrics['today_revenue'], 2) }}</p>
        </div>
    </div>
</div>
@endsection
