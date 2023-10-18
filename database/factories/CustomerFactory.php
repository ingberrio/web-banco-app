<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'adress' => $this->faker->address(),
            'identification' => $this->faker->uuid(),
            'tipo' => $this->faker->randomElement(['1', '2', '3']),
        ];

        $account = Account::factory()->create();
 
        $customer = Customer::factory()
                    ->count(3)
                    ->for($account)
                    ->create();
    }
}
