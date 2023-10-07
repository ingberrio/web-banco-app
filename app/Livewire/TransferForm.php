<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TransferForm extends Component
{
    public $balance;
    public $root_account_id;

    public function render()
    {
        return view('livewire.transfer-form');
    }

    public function transfer()
    {
        
        $this->emit('transferValues', [
            'balance' => $this->balance,
            'root_account_id' => $this->root_account_id,
        ]);
    }
}

