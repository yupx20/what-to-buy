<?php

namespace Database\Seeders;

use App\Models\CustomizationOption;
use Illuminate\Database\Seeder;

class CustomizationOptionSeeder extends Seeder
{
    /**
     * Seed the customization options table per PRD spec.
     */
    public function run(): void
    {
        // Ice Levels
        $iceLevels = [
            ['name' => 'Regular Ice (100%)', 'additional_price' => 0.00, 'sort_order' => 1],
            ['name' => 'Less Ice (70%)', 'additional_price' => 0.00, 'sort_order' => 2],
            ['name' => 'Slush (30%)', 'additional_price' => 0.00, 'sort_order' => 3],
            ['name' => 'No Ice (0%)', 'additional_price' => 0.50, 'sort_order' => 4],
            ['name' => 'Hot', 'additional_price' => 0.00, 'sort_order' => 5],
        ];

        foreach ($iceLevels as $option) {
            CustomizationOption::create(array_merge($option, [
                'type' => 'ice_level',
                'is_available' => true,
            ]));
        }

        // Sugar Levels
        $sugarLevels = [
            ['name' => 'Extra Sweet (100%)', 'additional_price' => 0.00, 'sort_order' => 1],
            ['name' => 'Regular (75%)', 'additional_price' => 0.00, 'sort_order' => 2],
            ['name' => 'Less Sweet (50%)', 'additional_price' => 0.00, 'sort_order' => 3],
            ['name' => 'Subtle (25%)', 'additional_price' => 0.00, 'sort_order' => 4],
            ['name' => 'Unsweetened (0%)', 'additional_price' => 0.00, 'sort_order' => 5],
        ];

        foreach ($sugarLevels as $option) {
            CustomizationOption::create(array_merge($option, [
                'type' => 'sugar_level',
                'is_available' => true,
            ]));
        }

        // Toppings
        $toppings = [
            ['name' => 'Tapioca Pearls', 'additional_price' => 0.75, 'sort_order' => 1],
            ['name' => 'Popping Boba', 'additional_price' => 0.85, 'sort_order' => 2],
            ['name' => 'Egg Pudding', 'additional_price' => 0.90, 'sort_order' => 3],
            ['name' => 'Coconut Jelly', 'additional_price' => 0.75, 'sort_order' => 4],
            ['name' => 'Signature Cheese Foam', 'additional_price' => 1.25, 'sort_order' => 5],
        ];

        foreach ($toppings as $option) {
            CustomizationOption::create(array_merge($option, [
                'type' => 'topping',
                'is_available' => true,
            ]));
        }
    }
}
