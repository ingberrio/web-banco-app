<?php

namespace App\Livewire\Accounts;

use Livewire\Component;
use App\Models\Account;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferAccount extends Component
{
    
    
    protected $listeners = ['transferAccount' => 'fillTransferForm'];
    

    public $root_account_id = '';
    public $destination_account_id ='';
    public $quantity = '';


    public function render()
    {
        return view('livewire.accounts.transfer-account');
    }

    public function transfer(Request $request)
    {
        dd($this->quantity);
        // Retrieve the ID associated with root_account_id and destination_account_id
        $rootAccountId = Account::where('identification', $this->root_account_id)->value('id');
        $destinationAccountId = Account::where('identification', $this->destination_account_id)->value('id');
        dd($rootAccountId);

        $rootAccount = Account::where('identification', $this->root_account_id)->first();
        $destinationAccount = Account::where('identification', $this->destination_account_id)->first();
        

        if (!$destinationAccount) {
             return redirect()->back()->with('error', 'Cuenta no encontradas');
        }
        
        if ($rootAccount->balance < $this->quantity) {
            return redirect()->back()->with('error', 'Saldo insuficiente para realizar la transferencia');
        }
        
        
        $rootAccount->balance -= $this->quantity;
        $destinationAccount->balance += $this->quantity;

        // Save in the accounts
        $rootAccount->save();
        $destinationAccount->save();

        // Create the transfer record using the retrieved IDs
        $accounts = Transfer::create([
            'root_account_id' => $rootAccountId,
            'destination_account_id' => $destinationAccountId,
            'quantity' => $this->quantity, 
        ]);
        
        session()->flash('message', 'Transfer created successfully.');
        
        return redirect('/accounts');
    }
    
    
    public function fillTransferForm($quantity, $rootAccountId)
    {
        $this->quantity = $quantity;
        $this->root_account_id = $rootAccountId;
    }
}
