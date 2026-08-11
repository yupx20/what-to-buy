<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed the products table.
     */
    public function run(): void
    {
        $classicId = Category::where('slug', 'classic-milk-tea')->first()->id;
        $fruitId = Category::where('slug', 'fruit-tea')->first()->id;
        $specialtyId = Category::where('slug', 'specialty')->first()->id;
        $seasonalId = Category::where('slug', 'seasonal-specials')->first()->id;

        $products = [
            // Classic Milk Tea
            [
                'category_id' => $classicId,
                'name' => 'Classic Pearl Milk Tea',
                'slug' => 'classic-pearl-milk-tea',
                'description' => 'Our signature blend of premium Assam black tea, creamy milk, and hand-made tapioca pearls. A timeless favorite.',
                'base_price' => 5.50,
                'badge_tag' => 'best_seller',
                'stock_quantity' => 150,
                'sort_order' => 1,
            ],
            [
                'category_id' => $classicId,
                'name' => 'Oolong Milk Tea',
                'slug' => 'oolong-milk-tea',
                'description' => 'Fragrant Tieguanyin oolong tea with silky milk. A sophisticated choice with floral undertones.',
                'base_price' => 5.75,
                'stock_quantity' => 120,
                'sort_order' => 2,
            ],
            [
                'category_id' => $classicId,
                'name' => 'Jasmine Green Milk Tea',
                'slug' => 'jasmine-green-milk-tea',
                'description' => 'Delicate jasmine-scented green tea paired with creamy milk. Light, refreshing, and aromatic.',
                'base_price' => 5.50,
                'badge_tag' => 'new',
                'stock_quantity' => 100,
                'sort_order' => 3,
            ],

            // Fruit Tea
            [
                'category_id' => $fruitId,
                'name' => 'Mango Passion Fruit Tea',
                'slug' => 'mango-passion-fruit-tea',
                'description' => 'Tropical mango and passion fruit blended with our premium green tea base. Refreshingly sweet.',
                'base_price' => 6.25,
                'badge_tag' => 'best_seller',
                'stock_quantity' => 130,
                'sort_order' => 1,
            ],
            [
                'category_id' => $fruitId,
                'name' => 'Lychee Rose Tea',
                'slug' => 'lychee-rose-tea',
                'description' => 'Sweet lychee and fragrant rose petals over iced black tea. A floral delight.',
                'base_price' => 6.50,
                'stock_quantity' => 90,
                'sort_order' => 2,
            ],
            [
                'category_id' => $fruitId,
                'name' => 'Strawberry Hibiscus Tea',
                'slug' => 'strawberry-hibiscus-tea',
                'description' => 'Fresh strawberry puree with tangy hibiscus tea. Beautiful and berry delicious.',
                'base_price' => 6.25,
                'stock_quantity' => 85,
                'sort_order' => 3,
            ],

            // Specialty
            [
                'category_id' => $specialtyId,
                'name' => 'Brown Sugar Tiger Milk',
                'slug' => 'brown-sugar-tiger-milk',
                'description' => 'Rich brown sugar syrup swirled with fresh milk and chewy tapioca. Our Instagram-worthy tiger stripe creation.',
                'base_price' => 6.75,
                'badge_tag' => 'best_seller',
                'stock_quantity' => 110,
                'sort_order' => 1,
            ],
            [
                'category_id' => $specialtyId,
                'name' => 'Matcha Cloud Latte',
                'slug' => 'matcha-cloud-latte',
                'description' => 'Ceremonial-grade matcha whisked with oat milk and topped with a fluffy cream cloud.',
                'base_price' => 7.00,
                'badge_tag' => 'new',
                'stock_quantity' => 75,
                'sort_order' => 2,
            ],
            [
                'category_id' => $specialtyId,
                'name' => 'Taro Velvet Milk Tea',
                'slug' => 'taro-velvet-milk-tea',
                'description' => 'Creamy taro root blended with jasmine milk tea. Smooth, sweet, and dreamily purple.',
                'base_price' => 6.50,
                'stock_quantity' => 95,
                'sort_order' => 3,
            ],

            // Seasonal Specials
            [
                'category_id' => $seasonalId,
                'name' => 'Summer Peach Oolong',
                'slug' => 'summer-peach-oolong',
                'description' => 'Sun-ripened white peach infused with premium oolong tea. Limited edition summer refresher.',
                'base_price' => 7.25,
                'badge_tag' => 'seasonal',
                'stock_quantity' => 60,
                'sort_order' => 1,
            ],
            [
                'category_id' => $seasonalId,
                'name' => 'Ube Coconut Frost',
                'slug' => 'ube-coconut-frost',
                'description' => 'Purple yam meets creamy coconut in this frozen tropical treat. A seasonal must-try.',
                'base_price' => 7.50,
                'badge_tag' => 'seasonal',
                'stock_quantity' => 45,
                'sort_order' => 2,
            ],
            [
                'category_id' => $seasonalId,
                'name' => 'Salted Caramel Boba Shake',
                'slug' => 'salted-caramel-boba-shake',
                'description' => 'Buttery salted caramel blended with vanilla ice cream and topped with mini boba pearls.',
                'base_price' => 7.75,
                'badge_tag' => 'seasonal',
                'stock_quantity' => 8,
                'sort_order' => 3,
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, [
                'is_in_stock' => $product['stock_quantity'] > 0,
            ]));
        }
    }
}
