<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItemCustomization extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'customization_option_id',
        'option_name',
        'option_type',
        'option_price',
    ];

    protected function casts(): array
    {
        return [
            'option_price' => 'decimal:2',
        ];
    }

    /**
     * Get the order item this customization belongs to.
     */
    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    /**
     * Get the customization option.
     */
    public function customizationOption(): BelongsTo
    {
        return $this->belongsTo(CustomizationOption::class);
    }
}
