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

    
}

