<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'fulfillment_type',
        'delivery_address',
        'pickup_time',
        'subtotal',
        'tax',
        'delivery_fee',
        'total_amount',
        'payment_method',
        'payment_status',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'tax' => 'decimal:2',
            'delivery_fee' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'pickup_time' => 'datetime',
        ];
    }

    /**
     * The status pipeline for order progression.
     */
    public const STATUS_PIPELINE = [
        'placed',
        'brewing',
        'out_for_delivery',
        'delivered',
        'completed',
    ];

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }

    /**
     * Generate a unique order number.
     */
    public static function generateOrderNumber(): string
    {
        $date = now()->format('Ymd');
        $random = strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));

        $orderNumber = "WTB-{$date}-{$random}";

        // Ensure uniqueness
        while (static::where('order_number', $orderNumber)->exists()) {
            $random = strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
            $orderNumber = "WTB-{$date}-{$random}";
        }

        return $orderNumber;
    }

    /**
     * Get the user who placed this order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items in this order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the formatted total amount.
     */
    protected function formattedTotal(): Attribute
    {
        return Attribute::get(fn () => '$' . number_format($this->total_amount, 2));
    }

    /**
     * Get the status label for display.
     */
    protected function statusLabel(): Attribute
    {
        return Attribute::get(fn () => match ($this->status) {
            'placed' => 'Order Placed',
            'brewing' => 'Brewing',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered',
            'completed' => 'Completed',
            default => ucfirst($this->status),
        });
    }

    /**
     * Get the status color class for badges.
     */
    protected function statusColor(): Attribute
    {
        return Attribute::get(fn () => match ($this->status) {
            'placed' => 'bg-yellow-100 text-yellow-800',
            'brewing' => 'bg-orange-100 text-orange-800',
            'out_for_delivery' => 'bg-blue-100 text-blue-800',
            'delivered' => 'bg-green-100 text-green-800',
            'completed' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        });
    }

    /**
     * Advance the order to the next status in the pipeline.
     */
    public function advanceStatus(): bool
    {
        $currentIndex = array_search($this->status, self::STATUS_PIPELINE);

        if ($currentIndex === false || $currentIndex >= count(self::STATUS_PIPELINE) - 1) {
            return false;
        }

        $this->status = self::STATUS_PIPELINE[$currentIndex + 1];
        return $this->save();
    }

    /**
     * Check if order can be advanced.
     */
    public function canAdvance(): bool
    {
        $currentIndex = array_search($this->status, self::STATUS_PIPELINE);
        return $currentIndex !== false && $currentIndex < count(self::STATUS_PIPELINE) - 1;
    }

    /**
     * Get the current step index (0-based) for the tracking timeline.
     */
    protected function statusStep(): Attribute
    {
        return Attribute::get(fn () => array_search($this->status, self::STATUS_PIPELINE));
    }

    /**
     * Scope to filter by status.
     */
    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get active orders (not completed).
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNotIn('status', ['completed']);
    }

    /**
     * Scope to order by latest.
     */
    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }
}
