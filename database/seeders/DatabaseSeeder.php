<?php

namespace Database\Seeders;

use App\Models\AppSetup;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\{User, WebsiteSetup};
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'uuid' => Str::uuid(),
            'name' => 'Test User',
            'email' => 'admin@atomshop.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'status' => 'active'
        ]);
        User::factory()->create([
            'uuid' => Str::uuid(),
            'name' => 'Test Seller',
            'email' => 'seller@atomshop.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'seller',
            'status' => 'active'
        ]);
        User::factory()->create([
            'uuid' => Str::uuid(),
            'name' => 'Test Customer',
            'email' => 'customer@atomshop.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'customer',
            'status' => 'active'
        ]);

        WebsiteSetup::create([
            'categories' => json_encode([]),
            'brands' => json_encode([]),
            'feature_products' => json_encode([]),
            'products' => json_encode([]),
            'sliders' => json_encode([])
        ]);
        AppSetup::create([
            'categories' => json_encode([]),
            'brands' => json_encode([]),
            'feature_products' => json_encode([]),
            'products' => json_encode([]),
            'sliders' => json_encode([])
        ]);
    }
}
