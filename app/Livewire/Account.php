<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account as AccountModel; 
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Account extends Component
{
    
    #[Rule('required')] 
    public $identification ='';
    #[Rule('required')] 
    public $name ='';
    public $balance ='';
    public $transactions_count ='';

     
    public $root_account_id = '';
     
    public $destination_account_id ='';
     
    public $quantity = '';

    public $selectedIdentification;
    protected $listeners = ['setQuantity' => 'setQuantity', 'setRootAccountId' => 'setRootAccountId'];

    public $disableCsrf = true;
    public $accounts;

    public function render()
    {
        $this->accounts = AccountModel::all();

        return view('livewire.account')
            ->layout('components.layouts.app');;
    }

    public function store(Request $request)
    {
        
        $this->validate([
            'identification' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric',
            'transactions_count' => 'integer|max:255',

        ]); 
        
        $account = AccountModel::create([
            'name' => $this->name,
            'identification' => $this->identification,
            'balance' => $this->balance,
            'transactions_count' => $this->transactions_count
        ]);

        session()->flash('message', 'Account created successfully.');
        
        // Redirect to the homepage
        return redirect()->route('accounts');
    }

    public function transfer(Request $request)
    {
        $this->validate([
            'root_account_id' => 'required|string|max:255',
            'destination_account_id' => 'required|string|max:255',
            'quantity' => 'required|numeric',
        ]);
        
        // Retrieve the ID associated with root_account_id and destination_account_id
        $rootAccountId = AccountModel::where('identification', $this->root_account_id)->value('id');
        $destinationAccountId = AccountModel::where('identification', $this->destination_account_id)->value('id');
        
        $rootAccount = AccountModel::where('identification', $this->root_account_id)->first();
        $destinationAccount = AccountModel::where('identification', $this->destination_account_id)->first();
    
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
        
        return redirect()->route('accounts');
    }
    
    public function fillTransferForm($balance, $identification)
    {
        $this->quantity = $balance;
        $this->root_account_id = $identification;    
        $this->render('div#transfer-form-container');
        
    }
    
    

}