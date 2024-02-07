<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'surname' => 'adm2',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'postal_code' => fake()->postcode(),
            'city' => fake()->city(),
            'state' => fake()->citySuffix(),
            'country' => fake()->country(),
            'position' => fake()->jobTitle(),
            'department' => fake()->companySuffix(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'block' => 0,
        ]);
        \App\Models\User::factory(100)->create();
        \App\Models\Client::factory(200)->create();

        $this->call([
            PermissionSeeder::class,
            AdminRoleSeeder::class
        ]);
    }
}
