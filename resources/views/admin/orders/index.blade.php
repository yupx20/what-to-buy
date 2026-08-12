@extends('layouts.admin')

@section('page_title', 'Order Operations Queue')

@section('content')
<div class="space-y-6">
    {{-- Filters --}}
    <div class="card-admin p-4">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
            {{-- Status Filter Tabs --}}
            <div class="flex flex-wrap gap-1">
                @php
                    $statuses = [
                        'all' => 'All',
                        'placed' => 'Placed',
                        'brewing' => 'Brewing',
                        'out_for_delivery' => 'On the Way',
                        'delivered' => 'Delivered',
                        'completed' => 'Completed',
                    ];
                @endphp
                @foreach($statuses as $key => $label)
                    <a href="{{ route('admin.orders.index', array_merge(request()->query(), ['status' => $key])) }}"
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors
                              {{ $status === $key ? 'bg-lavender-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $label }}
                        <span class="ml-1 opacity-70">({{ $statusCounts[$key] ?? 0 }})</span>
                    </a>
                @endforeach
            </div>

            {{-- Search --}}
            <form method="GET" action="{{ route('admin.orders.index') }}" class="sm:ml-auto flex gap-2">
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search orders..."
                       class="input py-1.5 text-sm w-48">
                <button type="submit" class="btn btn-sm btn-secondary">Search</button>
            </form>
        </div>
    </div>

    {{-- Orders Table --}}
    <div class="card-admin overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100 bg-gray-50/50">
                        <th class="px-5 py-3">Order #</th>
                        <th class="px-5 py-3">Customer</th>
                        <th class="px-5 py-3">Type</th>
                        <th class="px-5 py-3">Items</th>
                        <th class="px-5 py-3">Total</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Time</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors" id="order-row-{{ $order->id }}">
                            <td class="px-5 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}" class="font-mono text-xs font-semibold text-lavender-600 hover:text-lavender-700">
                                    {{ $order->order_number }}
                                </a>
                            </td>
                            <td class="px-5 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $order->customer_name }}</p>
                                    <p class="text-xs text-gray-400">{{ $order->customer_email }}</p>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-600">
                                    @if($order->fulfillment_type === 'delivery')
                                        <x-icon name="car" class="w-3.5 h-3.5" />
                                    @else
                                        <x-icon name="store" class="w-3.5 h-3.5" />
                                    @endif
                                    {{ ucfirst($order->fulfillment_type) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-gray-500">{{ $order->items->count() }}</td>
                            <td class="px-5 py-4 font-semibold text-gray-900">{{ $order->formatted_total }}</td>
                            <td class="px-5 py-4">
                                <span class="badge status-{{ $order->status }}" id="status-badge-{{ $order->id }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($order->canAdvance())
                                        <form method="POST" action="{{ route('admin.orders.advance', $order) }}" class="inline advance-form">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                Advance →
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-ghost">View</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-16 text-center">
                                <div class="w-14 h-14 rounded-xl bg-lavender-50 flex items-center justify-center mx-auto mb-3">
                                    <x-icon name="clipboard" class="w-7 h-7 text-lavender-400" />
                                </div>
                                <p class="text-gray-500">No orders found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $orders->withQueryString()->links() }}
    </div>
</div>
@endsection
