<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService,
    ) {}

    /**
     * Display the cart.
     */
    public function index()
    {
        $cartItems = $this->cartService->getItems();
        $subtotal = $this->cartService->getSubtotal();
        $tax = $this->cartService->getTax();
        $total = $this->cartService->getTotal();
        $itemCount = $this->cartService->getItemCount();

        return view('storefront.cart', compact('cartItems', 'subtotal', 'tax', 'total', 'itemCount'));
    }

    /**
     * Add an item to the cart.
     */
    public function add(AddToCartRequest $request)
    {
        try {
            $this->cartService->addItem(
                productId: $request->validated('product_id'),
                quantity: $request->validated('quantity'),
                iceLevelId: $request->validated('ice_level_id'),
                sugarLevelId: $request->validated('sugar_level_id'),
                toppingIds: $request->validated('topping_ids', []),
            );

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item added to cart!',
                    'cartCount' => $this->cartService->getItemCount(),
                    'cartTotal' => $this->cartService->getTotal(),
                ]);
            }

            return back()->with('success', 'Item added to cart!');
        } catch (\RuntimeException $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update item quantity.
     */
    public function update(Request $request, int $itemIndex)
    {
        $request->validate(['quantity' => 'required|integer|min:0|max:10']);

        $this->cartService->updateQuantity($itemIndex, $request->quantity);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'cartCount' => $this->cartService->getItemCount(),
                'subtotal' => $this->cartService->getSubtotal(),
                'tax' => $this->cartService->getTax(),
                'total' => $this->cartService->getTotal(),
            ]);
        }

        return back()->with('success', 'Cart updated.');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request, int $itemIndex)
    {
        $this->cartService->removeItem($itemIndex);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart.',
                'cartCount' => $this->cartService->getItemCount(),
                'subtotal' => $this->cartService->getSubtotal(),
                'tax' => $this->cartService->getTax(),
                'total' => $this->cartService->getTotal(),
            ]);
        }

        return back()->with('success', 'Item removed from cart.');
    }
}
