<?php

namespace App\Livewire\Accounts;

use Livewire\Component;
use App\Models\Account;

class ListAccount extends Component
{
    public $root_account_id;
    public $quantity;
    
    public $accounts;

    public function mount()
    {
        $this->accounts = Account::select(['id', 'name', 'balance', 'identification'])->get();
    }
    
    public function transferAccount($balance, $identification)
    {
        $this->dispatch('transferAccount', $balance, $identification);
    }
}
