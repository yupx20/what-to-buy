<?php

namespace Database\Seeders;

use App\Models\Testimony;
use Illuminate\Database\Seeder;

class TestimonySeeder extends Seeder
{
    /**
     * Seed sample testimonies.
     */
    public function run(): void
    {
        $testimonies = [
            [
                'customer_name' => 'Sarah M.',
                'rating' => 5,
                'review_text' => 'Absolutely obsessed with the Brown Sugar Tiger Milk! The tiger stripe swirl is gorgeous and the flavor is heavenly. Best boba I\'ve had outside of Taipei!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'James L.',
                'rating' => 5,
                'review_text' => 'The Matcha Cloud Latte is a game changer. Perfectly balanced, not too sweet, and the cream cloud on top is like drinking a dream. Will be back every week.',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Emily R.',
                'rating' => 4,
                'review_text' => 'Great selection and the customization options are perfect. I love being able to choose my exact sweetness level. The Mango Passion Fruit Tea is my go-to!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Marcus T.',
                'rating' => 5,
                'review_text' => 'Fast delivery and the drinks arrived perfectly sealed. The Classic Pearl Milk Tea is exactly what I was craving. Pearls were chewy and fresh!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Ava K.',
                'rating' => 4,
                'review_text' => 'The Taro Velvet is SO good and such a pretty purple color. The cheese foam topping is addictive. Only wish the portions were a little bigger!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'David P.',
                'rating' => 5,
                'review_text' => 'Been trying every seasonal special and they never disappoint. The Summer Peach Oolong is incredible — fruity, light, and refreshing. 10/10 would recommend.',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Lily C.',
                'rating' => 5,
                'review_text' => 'The ordering experience is so smooth! Love that I can pick my ice and sweetness levels. The Lychee Rose Tea with popping boba is my absolute favorite combo.',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Ryan W.',
                'rating' => 4,
                'review_text' => 'Solid boba spot! The Oolong Milk Tea has a really nice floral note that sets it apart from other shops. The egg pudding topping is a must-add.',
                'is_approved' => true,
            ],
        ];

        foreach ($testimonies as $testimony) {
            Testimony::create($testimony);
        }
    }
}
