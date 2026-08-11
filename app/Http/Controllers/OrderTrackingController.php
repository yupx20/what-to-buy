<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderTrackingController extends Controller
{
    /**
     * Display the order tracking page.
     */
    public function show(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with('items.customizations')
            ->firstOrFail();

        return view('storefront.order-tracking', compact('order'));
    }

    /**
     * Get the current order status (AJAX polling endpoint).
     */
    public function status(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        return response()->json([
            'status' => $order->status,
            'status_label' => $order->status_label,
            'status_step' => $order->status_step,
            'updated_at' => $order->updated_at->diffForHumans(),
        ]);
    }
}
