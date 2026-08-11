<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\Testimony;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    /**
     * Get all dashboard metrics, cached for performance.
     */
    public function getMetrics(): array
    {
        return Cache::remember('admin.dashboard.metrics', now()->addMinutes(5), function () {
            return [
                'total_revenue' => $this->getTotalRevenue(),
                'active_orders' => $this->getActiveOrderCount(),
                'low_stock_items' => $this->getLowStockCount(),
                'avg_rating' => $this->getAverageRating(),
                'today_orders' => $this->getTodayOrderCount(),
                'today_revenue' => $this->getTodayRevenue(),
            ];
        });
    }

    /**
     * Clear cached metrics.
     */
    public function clearCache(): void
    {
        Cache::forget('admin.dashboard.metrics');
    }

    /**
     * Get total revenue from paid orders.
     */
    private function getTotalRevenue(): float
    {
        return (float) Order::where('payment_status', 'paid')->sum('total_amount');
    }

    /**
     * Get count of active orders.
     */
    private function getActiveOrderCount(): int
    {
        return Order::active()->count();
    }

    /**
     * Get count of low stock products.
     */
    private function getLowStockCount(): int
    {
        return Product::where('stock_quantity', '<=', 10)
            ->where('stock_quantity', '>', 0)
            ->count();
    }

    /**
     * Get average customer satisfaction rating.
     */
    private function getAverageRating(): float
    {
        $avg = Testimony::approved()->avg('rating');
        return round($avg ?? 0, 1);
    }

    /**
     * Get today's order count.
     */
    private function getTodayOrderCount(): int
    {
        return Order::whereDate('created_at', today())->count();
    }

    /**
     * Get today's revenue.
     */
    private function getTodayRevenue(): float
    {
        return (float) Order::where('payment_status', 'paid')
            ->whereDate('created_at', today())
            ->sum('total_amount');
    }
}
