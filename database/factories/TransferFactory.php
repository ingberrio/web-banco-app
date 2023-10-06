<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\transfer>
 */
class TransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'balance' => fake()->randomFloat(2, 0, 1000000),
            'root_account_id' => $this->faker->numberBetween(1, 10),
            'destination_account_id' => $this->faker->numberBetween(1, 10),            
        ];
    }
}
