<?php

namespace App\Livewire\Accounts;

use Livewire\Component;
use App\Models\Account;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Livewire\Attributes\On; 

class TransferAccount extends Component
{
    
    //     try {
    //         $rootAccount = Account::where('identification', $this->root_account_id)->firstOrFail();
    //     }
    //     catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
    //     {
    //         // Model Not Found
    //         return redirect()->back()->with('error', 'Saldo insuficiente para realizar la transferencia');
    //     }
    //     catch (\Exception $e)
    //     {
    //         // Something else went wrong
    //         return redirect()->back()->with('error', 'Saldo insuficiente para realizar la transferencia');
    //     }
    // }
    #[Rule('required')]
    public $root_account_id = '';
    
    #[Rule('required')]
    public $destination_account_id ='';
    
    #[Rule('required')]
    public $quantity = '';


    public function mout()
    {
        
    }

    public function transfer(Request $request)
    {
        $this->validate([
            'root_account_id' => 'required|max:255',
            'destination_account_id' => 'required|max:255',
            'quantity' => 'required|numeric',
        ]); 
        
        // Retrieve the ID associated with root_account_id and destination_account_id
        $rootAccountId = Account::where('identification', $this->root_account_id)->value('id');
        $destinationAccountId = Account::where('identification', $this->destination_account_id)->value('id');
        $rootAccountBalance = Account::where('identification', $this->root_account_id)->value('balance');
        
        // Save in the accounts
        switch ($destinationAccountId) {
            case null:
                session()->flash('message', 'Verifica el ID de las cuentas.');
                break;
            case ($this->quantity <= 0):
                session()->flash('message', 'No puede ser 0.');
                break;
            case ($this->quantity > $rootAccountBalance):
                session()->flash('message', 'Saldo insuficiente.');
                break;
            default:
                // Perform the transfer
                $rootAccount = Account::where('identification', $this->root_account_id)->firstOrFail();
                $destinationAccount = Account::where('identification', $this->destination_account_id)->firstOrFail();    
                // Subtract the quantity from the root account
                $rootAccount->balance -= $this->quantity;
                    
                // Add the quantity from the root account
                $destinationAccount->balance += $this->quantity;
        
                // Increment the transactions_count of the model account
                $rootAccount->increment('transactions_count');
                    
                $rootAccount->save();
                $destinationAccount->save();
                    
                // Create the transfer record using the retrieved IDs
                Transfer::create([
                    'root_account_id' => $rootAccountId,
                    'destination_account_id' => $destinationAccountId,
                    'quantity' => $this->quantity, 
                ]);
                    
                session()->flash('message', 'Transfer created successfully.');
        }
        
        return redirect('/accounts');
    }
    
    /**
     * FILEPATH: /web-banco-app/app/Livewire/Accounts/TransferAccount.php
     * 
     * This method is triggered when the 'transferAccount' event is emitted. It fills the transfer form with the given balance and identification.
     *
     * @param float $balance The balance to be transferred.
     * @param int $identification The identification of the root account.
     * @return void
     */
    #[On('transferAccount')]
    
    public function fillTransferForm($balance, $identification)
    {
        $this->root_account_id = $identification;
        $this->quantity = $balance;
    }
}
