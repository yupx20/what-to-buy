<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
        protected DashboardService $dashboardService,
    ) {}

    /**
     * Display the order operations queue.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $search = $request->query('search');

        $orders = $this->orderService->getOrdersForAdmin($status, $search);
        $statusCounts = [
            'all' => Order::count(),
            'placed' => Order::byStatus('placed')->count(),
            'brewing' => Order::byStatus('brewing')->count(),
            'out_for_delivery' => Order::byStatus('out_for_delivery')->count(),
            'delivered' => Order::byStatus('delivered')->count(),
            'completed' => Order::byStatus('completed')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'status', 'search', 'statusCounts'));
    }

    /**
     * Display order details.
     */
    public function show(Order $order)
    {
        $order->load('items.customizations', 'user');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Advance an order to the next status.
     */
    public function advanceStatus(Request $request, Order $order)
    {
        try {
            $order = $this->orderService->advanceOrderStatus($order);
            $this->dashboardService->clearCache();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'status' => $order->status,
                    'status_label' => $order->status_label,
                    'status_color' => $order->status_color,
                    'can_advance' => $order->canAdvance(),
                ]);
            }

            return back()->with('success', "Order advanced to {$order->status_label}.");
        } catch (\RuntimeException $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
            return back()->with('error', $e->getMessage());
        }
    }
}
