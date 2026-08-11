<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the categories table.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Classic Milk Tea', 'slug' => 'classic-milk-tea', 'sort_order' => 1],
            ['name' => 'Fruit Tea', 'slug' => 'fruit-tea', 'sort_order' => 2],
            ['name' => 'Specialty', 'slug' => 'specialty', 'sort_order' => 3],
            ['name' => 'Seasonal Specials', 'slug' => 'seasonal-specials', 'sort_order' => 4],
        ];

        foreach ($categories as $category) {
            Category::create(array_merge($category, ['is_active' => true]));
        }
    }
}
