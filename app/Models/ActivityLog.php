<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'action_url',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    /**
     * Get the user associated with this log entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a log entry.
     */
    public static function log(
        string $type,
        string $title,
        string $message,
        ?string $actionUrl = null,
        ?array $metadata = null
    ): static {
        return static::create([
            'user_id' => auth()->id(),
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'action_url' => $actionUrl,
            'metadata' => $metadata,
        ]);
    }

    /**
     * Scope to filter by type.
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to order by latest.
     */
    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }
}
