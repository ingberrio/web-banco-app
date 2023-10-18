<?php

namespace Database\Factories;
use App\Models\Account;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        // Obtener un cliente existente o crear uno nuevo
        $customer = Customer::inRandomOrder()->first() ?? Customer::factory()->create();

        return [
            'name' => $this->faker->name,
            'identification' => $this->faker->uuid,
            'balance' => $this->faker->randomFloat(2, 0, 10000),
            'transactions_count' => $this->faker->numberBetween(0, 100),
            'customer_id' => $customer->id, // Asignar el ID del cliente
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
