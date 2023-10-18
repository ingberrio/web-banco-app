<?php

namespace Database\Factories;
use App\Models\Account;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
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
            'quantity' => $this->faker->randomFloat(10, 2),
            'root_account_id' => $this->faker->randomNumber(1, 20),
            'destination_account_id' => $this->faker->randomNumber(1, 20),
        ];

        $account = Account::factory()->create();
 
        $transfer = Transfer::factory()
                    ->count(3)
                    ->for($account)
                    ->create();
    }

}
