@extends('layouts.admin')

@section('page_title', 'Edit — ' . $product->name)

@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-lavender-600 transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Back to Products
    </a>

    <div class="card-admin p-6">
        <h2 class="font-display font-bold text-lg text-gray-900 mb-6">Edit Product</h2>

        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="input-label" for="name">Product Name</label>
                <input type="text" name="name" id="name" class="input @error('name') input-error @enderror"
                       value="{{ old('name', $product->name) }}" required>
                @error('name') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="input-label" for="description">Description</label>
                <textarea name="description" id="description" rows="3" class="input @error('description') input-error @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="input-label" for="base_price">Base Price ($)</label>
                    <input type="number" name="base_price" id="base_price" step="0.01" min="0" class="input @error('base_price') input-error @enderror"
                           value="{{ old('base_price', $product->base_price) }}" required>
                    @error('base_price') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="input-label" for="stock_quantity">Stock Quantity</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" min="0" class="input @error('stock_quantity') input-error @enderror"
                           value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                    @error('stock_quantity') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="input-label" for="badge_tag">Badge Tag</label>
                <select name="badge_tag" id="badge_tag" class="input">
                    <option value="">None</option>
                    <option value="best_seller" {{ old('badge_tag', $product->badge_tag) === 'best_seller' ? 'selected' : '' }}>Best Seller</option>
                    <option value="seasonal" {{ old('badge_tag', $product->badge_tag) === 'seasonal' ? 'selected' : '' }}>Seasonal</option>
                    <option value="new" {{ old('badge_tag', $product->badge_tag) === 'new' ? 'selected' : '' }}>New</option>
                </select>
            </div>

            <div>
                <label class="input-label" for="image">Product Image <span class="text-gray-400 font-normal">(optional, max 2MB)</span></label>
                @if($product->image_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-20 h-20 rounded-xl object-cover">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*" class="input">
                @error('image') <p class="text-strawberry-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
