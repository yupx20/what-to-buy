<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected OrderService $orderService,
    ) {}

    /**
     * Step 1: Fulfillment & contact info.
     */
    public function index()
    {
        if ($this->cartService->isEmpty()) {
            return redirect()->route('menu')->with('error', 'Your cart is empty. Add some drinks first!');
        }

        $cartItems = $this->cartService->getItems();
        $subtotal = $this->cartService->getSubtotal();
        $tax = $this->cartService->getTax();
        $user = auth()->user();

        return view('storefront.checkout', compact('cartItems', 'subtotal', 'tax', 'user'));
    }

    /**
     * Step 2: Review & place order.
     */
    public function store(PlaceOrderRequest $request)
    {
        if ($this->cartService->isEmpty()) {
            return redirect()->route('menu')->with('error', 'Your cart is empty.');
        }

        try {
            $order = $this->orderService->createOrder($request->validated());

            return redirect()
                ->route('order.track', $order->order_number)
                ->with('success', 'Order placed successfully! Your order number is ' . $order->order_number);
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
