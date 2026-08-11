<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemCustomization;
use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        protected CartService $cartService,
        protected ActivityLogService $activityLogService,
    ) {}

    /**
     * Create an order from the current cart.
     */
    public function createOrder(array $data): Order
    {
        $cartItems = $this->cartService->getItems();

        if (empty($cartItems)) {
            throw new \RuntimeException('Cart is empty.');
        }

        $fulfillmentType = $data['fulfillment_type'] ?? 'pickup';
        $subtotal = $this->cartService->getSubtotal();
        $tax = $this->cartService->getTax();
        $deliveryFee = $this->cartService->getDeliveryFee($fulfillmentType);
        $total = $this->cartService->getTotal($fulfillmentType);

        return DB::transaction(function () use ($data, $cartItems, $fulfillmentType, $subtotal, $tax, $deliveryFee, $total) {
            // Create the order
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'] ?? null,
                'fulfillment_type' => $fulfillmentType,
                'delivery_address' => $data['delivery_address'] ?? null,
                'pickup_time' => $data['pickup_time'] ?? null,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'delivery_fee' => $deliveryFee,
                'total_amount' => $total,
                'payment_method' => $data['payment_method'] ?? 'card',
                'payment_status' => 'paid', // Simulated payment
                'status' => 'placed',
                'notes' => $data['notes'] ?? null,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem['product_id'],
                    'product_name' => $cartItem['product_name'],
                    'quantity' => $cartItem['quantity'],
                    'unit_price' => $cartItem['unit_price'],
                    'total_price' => $cartItem['total_price'],
                ]);

                // Create customizations
                foreach ($cartItem['customizations'] as $customization) {
                    OrderItemCustomization::create([
                        'order_item_id' => $orderItem->id,
                        'customization_option_id' => $customization['id'],
                        'option_name' => $customization['name'],
                        'option_type' => $customization['type'],
                        'option_price' => $customization['price'],
                    ]);
                }

                // Decrement stock
                Product::where('id', $cartItem['product_id'])
                    ->decrement('stock_quantity', $cartItem['quantity']);

                // Check if stock is now low
                $product = Product::find($cartItem['product_id']);
                if ($product && $product->stock_quantity <= 0) {
                    $product->update(['is_in_stock' => false]);
                }
                if ($product && $product->isLowStock()) {
                    $this->activityLogService->log(
                        'stock',
                        'Low Stock Alert',
                        "{$product->name} has only {$product->stock_quantity} units remaining.",
                        route('admin.products.index')
                    );
                }
            }

            // Log the order
            $this->activityLogService->log(
                'order',
                'New Order Received',
                "Order {$order->order_number} placed by {$order->customer_name} for {$order->formatted_total}.",
                route('admin.orders.show', $order)
            );

            // Clear the cart
            $this->cartService->clear();

            return $order;
        });
    }

    /**
     * Advance an order to the next status.
     */
    public function advanceOrderStatus(Order $order): Order
    {
        $previousStatus = $order->status_label;

        if (!$order->advanceStatus()) {
            throw new \RuntimeException('This order cannot be advanced further.');
        }

        $this->activityLogService->log(
            'order',
            'Order Status Updated',
            "Order {$order->order_number} moved from {$previousStatus} to {$order->status_label}.",
            route('admin.orders.show', $order)
        );

        return $order->fresh();
    }

    /**
     * Get orders filtered and paginated for admin.
     */
    public function getOrdersForAdmin(?string $status = null, ?string $search = null, int $perPage = 20)
    {
        $query = Order::with('items')->latestFirst();

        if ($status && $status !== 'all') {
            $query->byStatus($status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        return $query->paginate($perPage);
    }
}
