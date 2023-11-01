<?php

namespace Tests\Feature;

use App\Livewire\Accounts\CreateAccount;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AccountTransferTest extends TestCase
{
    use RefreshDatabase;

    public function test_account_can_be_created()
    {
        Livewire::test(CreateAccount::class)
            ->set('identification', '123456789')
            ->set('name', 'John Doe')
            ->set('balance', 1000)
            ->call('store')
            ->assertSessionHas('message', 'Account created successfully.');

        $account = Account::first();

        $this->assertEquals('123456789', $account->identification);
        $this->assertEquals('John Doe', $account->name);
        $this->assertEquals(1000, $account->balance);
    }
}
