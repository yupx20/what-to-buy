<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\CustomizationOption;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    /**
     * Display the landing/home page.
     */
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->inStock()
            ->whereNotNull('badge_tag')
            ->sorted()
            ->take(8)
            ->get();

        $categories = Category::active()->sorted()->get();

        return view('storefront.home', compact('featuredProducts', 'categories'));
    }

    /**
     * Display the full menu page.
     */
    public function menu(Request $request)
    {
        $categories = Category::active()->sorted()->get();
        $activeCategory = $request->query('category');

        $query = Product::with('category')->inStock()->sorted();

        if ($activeCategory) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $activeCategory));
        }

        $products = $query->get();

        $customizationOptions = CustomizationOption::available()
            ->sorted()
            ->get()
            ->groupBy('type');

        return view('storefront.menu', compact(
            'categories',
            'activeCategory',
            'products',
            'customizationOptions'
        ));
    }

    /**
     * Display a single product (SEO page).
     */
    public function show(Product $product)
    {
        $product->load('category');

        $customizationOptions = CustomizationOption::available()
            ->sorted()
            ->get()
            ->groupBy('type');

        $relatedProducts = Product::inStock()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('storefront.product-show', compact(
            'product',
            'customizationOptions',
            'relatedProducts'
        ));
    }
}
