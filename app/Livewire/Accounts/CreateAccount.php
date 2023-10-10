<?php

namespace App\Livewire\Accounts;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Account;

class CreateAccount extends Component
{
    #[Rule('required')] 
    public $identification ='';
    #[Rule('required')] 
    public $name ='';
    public $balance ='';
    public $transactions_count ='';

    public function render()
    {
        return view('livewire.accounts.create-account');
    }

    public function store(Request $request)
    {
        $this->validate([
            'identification' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric',
            'transactions_count' => 'integer|max:255',
        ]); 
        
        $account = Account::create([
            'name' => $this->name,
            'identification' => $this->identification,
            'balance' => $this->balance,
            'transactions_count' => $this->transactions_count
        ]);

        session()->flash('message', 'Account created successfully.');
        
        // Redirect to the homepage
        return redirect()->route('accounts');
    }


}
