<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account as AccountModel; 
use App\Models\Transfer;
use Illuminate\Http\Request;

class Account extends Component
{
    public $identification ='';
    public $name ='';
    public $balance ='';

    public $root_account_id ='';
    public $destination_account_id ='';
    public $quantity = '';
    
    public $accounts;

    public function render()
    {
        $this->accounts = AccountModel::all();

        return view('livewire.account')
            ->layout('components.layouts.app');;
    }

    public function store(Request $request)
    {
        $account = AccountModel::create([
            'name' => $this->name,
            'identification' => $this->identification,
            'balance' => $this->balance
        ]);

        session()->flash('message', 'Account created successfully.');

        return redirect()->route('accounts');
    }

    public function transfer(Request $request)
    {
        // Retrieve the ID associated with root_account_id and destination_account_id
        $rootAccountId = AccountModel::where('identification', $this->root_account_id)->value('id');
        $destinationAccountId = AccountModel::where('identification', $this->destination_account_id)->value('id');
        
        // Check if the IDs were found
        if (!$destinationAccountId) {
            session()->flash('error', 'One or both accounts not found.');
            return;
        }
        // Create the transfer record using the retrieved IDs
        $transfer = Transfer::create([
            'root_account_id' => $rootAccountId,
            'destination_account_id' => $destinationAccountId,
            'quantity' => $this->quantity
        ]);

        session()->flash('message', 'Transfer created successfully.');

        return redirect()->route('accounts');
    }

    public function fillTransferForm($accountId)
    {
        $this->root_account_id = $accountId;
    }

    public function emitTransferValues($monto, $cedulaOrigen)
    {
        $this->emit('transferValues', [
            'monto' => $monto,
            'cedulaOrigen' => $cedulaOrigen,
        ]);
    }

    
}
