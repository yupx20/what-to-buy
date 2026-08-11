<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the admin user.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@whattobuy.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '(555) 000-0001',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@whattobuy.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone_number' => '(555) 000-0002',
            'email_verified_at' => now(),
        ]);
    }
}
