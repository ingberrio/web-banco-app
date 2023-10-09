<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Account as AccountModel;


class AccountTransferTest extends TestCase
{
    public function testTransfer()
    {
        // Crear cuentas de prueba en la base de datos
        $rootAccount = AccountModel::create([
            'name' => 'Root Account',
            'identification' => '123457',
            'balance' => 1000.00,
            'transactions_count' => 0,
        ]);
        
        $destinationAccount = AccountModel::create([
            'name' => 'Destination Account',
            'identification' => '123456',
            'balance' => 500.00,
            'transactions_count' => 0,
        ]);

        // Datos de transferencia simulada
        $data = [
            'root_account_id' => '123457', // Identificación de la cuenta origen
            'destination_account_id' => '123456', // Identificación de la cuenta destino
            'quantity' => 200.00, // Cantidad a transferir
        ];

        // Realizar una solicitud POST a la acción 'transfer' con los datos de transferencia
        $response = $this->post(route('accounts.transfer'), $data);

        // Verificar que los saldos de las cuentas se hayan actualizado correctamente
        $rootAccount->refresh();
        $destinationAccount->refresh();

        $this->assertEquals(800.00, $rootAccount->balance); // El saldo de la cuenta origen se debe reducir
        $this->assertEquals(700.00, $destinationAccount->balance); // El saldo de la cuenta destino se debe aumentar
    }
}
