<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'base_price',
        'image_path',
        'badge_tag',
        'is_in_stock',
        'stock_quantity',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'base_price' => 'decimal:2',
            'is_in_stock' => 'boolean',
        ];
    }

    /**
     * Get the category this product belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items for this product.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the formatted price attribute.
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::get(fn () => '$' . number_format($this->base_price, 2));
    }

    /**
     * Get the display badge text.
     */
    protected function badgeText(): Attribute
    {
        return Attribute::get(fn () => match ($this->badge_tag) {
            'best_seller' => 'Best Seller',
            'seasonal' => 'Seasonal',
            'new' => 'New',
            default => null,
        });
    }

    /**
     * Scope to only in-stock products.
     */
    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('is_in_stock', true);
    }

    /**
     * Scope to filter by badge tag.
     */
    public function scopeByBadge(Builder $query, string $badge): Builder
    {
        return $query->where('badge_tag', $badge);
    }

    /**
     * Scope to order by sort_order.
     */
    public function scopeSorted(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Check if stock is low (below threshold).
     */
    public function isLowStock(int $threshold = 10): bool
    {
        return $this->stock_quantity <= $threshold;
    }
}
