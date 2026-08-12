@extends('layouts.admin')

@section('page_title', 'Inventory Control')

@section('content')
<div class="space-y-6">
    {{-- Low Stock Alert --}}
    @if($lowStockProducts->isNotEmpty())
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <x-icon name="alert-triangle" class="w-5 h-5 text-amber-500" />
                <div>
                    <p class="font-semibold text-amber-800 text-sm">Low Stock Alert</p>
                    <p class="text-xs text-amber-600">
                        {{ $lowStockProducts->count() }} {{ Str::plural('product', $lowStockProducts->count()) }} running low:
                        {{ $lowStockProducts->pluck('name')->join(', ') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    {{-- Filters --}}
    <div class="card-admin p-4">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search products..."
                   class="input py-1.5 text-sm flex-1">
            <select name="category" class="input py-1.5 text-sm w-auto">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
        </form>
    </div>

    {{-- Products Table --}}
    <div class="card-admin overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100 bg-gray-50/50">
                        <th class="px-5 py-3">Product</th>
                        <th class="px-5 py-3">Category</th>
                        <th class="px-5 py-3">Price</th>
                        <th class="px-5 py-3">Stock</th>
                        <th class="px-5 py-3">Badge</th>
                        <th class="px-5 py-3">Availability</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors" id="product-row-{{ $product->id }}">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-lavender-50 flex items-center justify-center text-lg flex-shrink-0">
                                        @if($product->image_path)
                                        <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover rounded-xl">
                                    @else
                                        <x-icon name="boba" class="w-5 h-5 text-lavender-300" />
                                    @endif
                                    </div>
                                    <span class="font-semibold text-gray-900">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-gray-500">{{ $product->category->name ?? '—' }}</td>
                            <td class="px-5 py-4 font-semibold text-gray-900">${{ number_format($product->base_price, 2) }}</td>
                            <td class="px-5 py-4">
                                <span class="{{ $product->isLowStock() ? 'text-amber-600 font-semibold' : 'text-gray-700' }}">
                                    {{ $product->stock_quantity }}
                                    @if($product->isLowStock())
                                        <span class="text-[10px] text-amber-500">LOW</span>
                                    @endif
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                @if($product->badge_tag)
                                    <span class="badge badge-{{ str_replace('_', '-', $product->badge_tag) }}">{{ $product->badge_text }}</span>
                                @else
                                    <span class="text-gray-300">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <form method="POST" action="{{ route('admin.products.toggle-stock', $product) }}" class="inline toggle-stock-form">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="toggle {{ $product->is_in_stock ? 'active' : '' }}"
                                            title="{{ $product->is_in_stock ? 'In Stock — click to mark out of stock' : 'Out of Stock — click to mark in stock' }}"
                                            aria-label="Toggle stock for {{ $product->name }}">
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-ghost">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center text-gray-400">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
