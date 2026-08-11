<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService,
    ) {}

    /**
     * Display the inventory control panel.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoryId = $request->query('category');

        $products = $this->inventoryService->getProductsForAdmin($search, $categoryId);
        $categories = Category::active()->sorted()->get();
        $lowStockProducts = $this->inventoryService->getLowStockProducts();

        return view('admin.products.index', compact('products', 'categories', 'search', 'categoryId', 'lowStockProducts'));
    }

    /**
     * Show the product edit form.
     */
    public function edit(Product $product)
    {
        $categories = Category::active()->sorted()->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the product.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', "{$product->name} updated successfully.");
    }

    /**
     * Toggle stock availability.
     */
    public function toggleStock(Request $request, Product $product)
    {
        $product = $this->inventoryService->toggleStock($product);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'is_in_stock' => $product->is_in_stock,
                'message' => $product->name . ' is now ' . ($product->is_in_stock ? 'in stock' : 'out of stock') . '.',
            ]);
        }

        return back()->with('success', $product->name . ' stock status updated.');
    }
}
