<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class InventoryService
{
    public function __construct(
        protected ActivityLogService $activityLogService,
    ) {}

    /**
     * Toggle stock availability for a product.
     */
    public function toggleStock(Product $product): Product
    {
        $product->is_in_stock = !$product->is_in_stock;
        $product->save();

        $status = $product->is_in_stock ? 'In Stock' : 'Out of Stock';
        $this->activityLogService->log(
            'stock',
            'Stock Status Changed',
            "{$product->name} marked as {$status}.",
            route('admin.products.index')
        );

        return $product;
    }

    /**
     * Update a product's base price.
     */
    public function updatePrice(Product $product, float $price): Product
    {
        $oldPrice = $product->base_price;
        $product->base_price = $price;
        $product->save();

        $this->activityLogService->log(
            'stock',
            'Price Updated',
            "{$product->name} price changed from \${$oldPrice} to \${$price}.",
            route('admin.products.index')
        );

        return $product;
    }

    /**
     * Get products with low stock.
     */
    public function getLowStockProducts(int $threshold = 10): Collection
    {
        return Product::where('stock_quantity', '<=', $threshold)
            ->where('stock_quantity', '>', 0)
            ->orderBy('stock_quantity')
            ->get();
    }

    /**
     * Get all products for admin, optionally filtered.
     */
    public function getProductsForAdmin(?string $search = null, ?int $categoryId = null, int $perPage = 20)
    {
        $query = Product::with('category')->orderBy('sort_order');

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->paginate($perPage);
    }
}
