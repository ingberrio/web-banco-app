<?php

namespace App\Livewire\Accounts;

use Livewire\Component;
use App\Models\Account;

class ListAccount extends Component
{
    public $root_account_id;
    public $quantity;
    
    
    public function render()
    {
        
        return view('livewire.accounts.list-account',[
                'accounts' => Account::all()
            ]   
        );
    }
    
    public function fillTransferForm($balance, $identification)
    {
        $this->dispatch('fillTransferForm', $this->quantity, $this->root_account_id);
    
    }

}
