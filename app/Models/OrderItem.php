<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'unit_price',
        'total_price',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    /**
     * Get the order this item belongs to.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product for this item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the customizations for this item.
     */
    public function customizations(): HasMany
    {
        return $this->hasMany(OrderItemCustomization::class);
    }
}
