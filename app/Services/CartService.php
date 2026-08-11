<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\CustomizationOption;

class CartService
{
    private const SESSION_KEY = 'cart';

    /**
     * Get all items in the cart.
     */
    public function getItems(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    /**
     * Add an item to the cart.
     */
    public function addItem(
        int $productId,
        int $quantity,
        ?int $iceLevelId = null,
        ?int $sugarLevelId = null,
        array $toppingIds = []
    ): array {
        $product = Product::findOrFail($productId);

        if (!$product->is_in_stock) {
            throw new \RuntimeException('This product is currently out of stock.');
        }

        // Build customizations array
        $customizations = [];
        $customizationTotal = 0;

        if ($iceLevelId) {
            $option = CustomizationOption::findOrFail($iceLevelId);
            $customizations[] = [
                'id' => $option->id,
                'type' => 'ice_level',
                'name' => $option->name,
                'price' => (float) $option->additional_price,
            ];
            $customizationTotal += (float) $option->additional_price;
        }

        if ($sugarLevelId) {
            $option = CustomizationOption::findOrFail($sugarLevelId);
            $customizations[] = [
                'id' => $option->id,
                'type' => 'sugar_level',
                'name' => $option->name,
                'price' => (float) $option->additional_price,
            ];
            $customizationTotal += (float) $option->additional_price;
        }

        if (count($toppingIds) > 3) {
            throw new \RuntimeException('You can select a maximum of 3 toppings.');
        }

        foreach ($toppingIds as $toppingId) {
            $option = CustomizationOption::findOrFail($toppingId);
            $customizations[] = [
                'id' => $option->id,
                'type' => 'topping',
                'name' => $option->name,
                'price' => (float) $option->additional_price,
            ];
            $customizationTotal += (float) $option->additional_price;
        }

        $unitPrice = (float) $product->base_price + $customizationTotal;

        $cartItem = [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_slug' => $product->slug,
            'product_image' => $product->image_path,
            'base_price' => (float) $product->base_price,
            'customizations' => $customizations,
            'customization_total' => $customizationTotal,
            'unit_price' => $unitPrice,
            'quantity' => $quantity,
            'total_price' => $unitPrice * $quantity,
        ];

        $cart = $this->getItems();
        $cart[] = $cartItem;
        Session::put(self::SESSION_KEY, $cart);

        return $cartItem;
    }

    /**
     * Update the quantity of a cart item.
     */
    public function updateQuantity(int $itemIndex, int $quantity): bool
    {
        $cart = $this->getItems();

        if (!isset($cart[$itemIndex])) {
            return false;
        }

        if ($quantity <= 0) {
            return $this->removeItem($itemIndex);
        }

        $cart[$itemIndex]['quantity'] = $quantity;
        $cart[$itemIndex]['total_price'] = $cart[$itemIndex]['unit_price'] * $quantity;
        Session::put(self::SESSION_KEY, $cart);

        return true;
    }

    /**
     * Remove an item from the cart.
     */
    public function removeItem(int $itemIndex): bool
    {
        $cart = $this->getItems();

        if (!isset($cart[$itemIndex])) {
            return false;
        }

        unset($cart[$itemIndex]);
        Session::put(self::SESSION_KEY, array_values($cart));

        return true;
    }

    /**
     * Clear the entire cart.
     */
    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    /**
     * Get the number of items in the cart.
     */
    public function getItemCount(): int
    {
        return array_sum(array_column($this->getItems(), 'quantity'));
    }

    /**
     * Get the cart subtotal.
     */
    public function getSubtotal(): float
    {
        return array_sum(array_column($this->getItems(), 'total_price'));
    }

    /**
     * Calculate tax (8% rate).
     */
    public function getTax(): float
    {
        return round($this->getSubtotal() * 0.08, 2);
    }

    /**
     * Get delivery fee based on fulfillment type.
     */
    public function getDeliveryFee(string $fulfillmentType = 'pickup'): float
    {
        return $fulfillmentType === 'delivery' ? 3.99 : 0.00;
    }

    /**
     * Get the cart total.
     */
    public function getTotal(string $fulfillmentType = 'pickup'): float
    {
        return round($this->getSubtotal() + $this->getTax() + $this->getDeliveryFee($fulfillmentType), 2);
    }

    /**
     * Check if the cart is empty.
     */
    public function isEmpty(): bool
    {
        return empty($this->getItems());
    }
}
