<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogService;
use App\Services\DashboardService;
use App\Models\Order;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService,
        protected ActivityLogService $activityLogService,
    ) {}

    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $metrics = $this->dashboardService->getMetrics();
        $recentActivity = $this->activityLogService->getRecent(limit: 10);
        $recentOrders = Order::with('items')
            ->latestFirst()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('metrics', 'recentActivity', 'recentOrders'));
    }
}
