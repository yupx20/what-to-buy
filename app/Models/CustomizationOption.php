<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CustomizationOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'additional_price',
        'is_available',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'additional_price' => 'decimal:2',
            'is_available' => 'boolean',
        ];
    }

    /**
     * Scope to only available options.
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope to filter by type.
     */
    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to order by sort_order.
     */
    public function scopeSorted(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }
}
