<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Testimony extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'rating',
        'review_text',
        'photo_path',
        'is_approved',
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
            'rating' => 'integer',
        ];
    }

    /**
     * Get the user who wrote this testimony.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to only approved testimonies.
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope to order by latest.
     */
    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }
}
