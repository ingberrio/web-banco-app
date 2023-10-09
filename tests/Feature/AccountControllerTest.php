<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        $data = [
            'identification' => '1234567890',
            'name' => 'Nombre de Prueba',
            'balance' => 1000,
            'transactions_count' => 0,
        ];

        $response = $this->post(route('accounts.store'), $data);
        
        // Verificar que se haya creado un registro en la base de datos
        $this->assertDatabaseHas('accounts', [
            'identification' => '1234567890',
            'name' => 'Nombre de Prueba',
            'balance' => 1000,
            'transactions_count' => 0,
        ]);
    }
}
