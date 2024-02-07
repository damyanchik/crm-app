<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company' => fake()->unique()->company(),
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'postal_code' => fake()->postcode(),
            'city' => fake()->city(),
            'state' => fake()->countryCode(),
            'country' => fake()->country(),
            'tax' => fake()->unique()->phoneNumber(),
            'user_id' => rand(1, 100)
        ];
    }
}
