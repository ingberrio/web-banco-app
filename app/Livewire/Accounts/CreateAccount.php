<?php

namespace App\Livewire\Accounts;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Account;
use App\Models\Costumer;

class CreateAccount extends Component
{
    #[Rule('required|unique', message: 'Debe ingresar un id')] 
    public $identification ='';
    
    #[Rule('required')] 
    public $name ='';
    
    public $tipo ='';

    public $balance ='';
    public $transactions_count ='';

    public $adress ='';
    public $phone ='';
    public $email ='';

    public $costumer_id ='';


    public function render()
    {
        return view('livewire.accounts.create-account');
    }

    public function store(Request $request)
    {
        
        $identification = $this->identification;
       
        // Verificar si el cliente ya existe
        $costumer = Costumer::where('identification', $identification)->first();
        
        if (!$costumer) {
            // Si no existe, crea un nuevo cliente
            $costumer = Costumer::create([
                'name' => $request->input('name'),
                'identification' => $identification,
            ]);
        }

        $this->validate([
            'identification' => 'required|string|max:255|unique:accounts,identification,except,id',
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric',
            'transactions_count' => 'integer|max:255',
        ]); 
        
        $account = Account::create([
            'name' => $this->name,
            'identification' => $this->identification,
            'balance' => $this->balance,
            'transactions_count' => $this->transactions_count,
            'tipo' => $this->tipo
        ]);

        session()->flash('message', 'Account created successfully.');
        
        // Redirect to the homepage
        return redirect('/accounts');
    }


}
