<div class="flex mb-4">
    <div class="w-1/2 p-2 text-left bg-blue-100 ">
        <div class="bg-white shadow-md rounded-lg p-5">
            <h1 class="text-2xl font-bold">Creación de cuentas</h1>
            <hr class="mt-4 mb-4 pb-3">

            <div class="w-full p-2 text-center">
                @if (session()->has('message'))
                    <div class="bg-green-500 text-white p-2 rounded-lg">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            </br>
            <form  wire:submit.prevent="store">
                
                <div class="flex flex-col mb-4">
                    <label class="text-sm font-bold">Cédula</label>
                    <input type="text" wire:model="identification" class="w-full p-2 border-2 rounded-lg" name="identification" id="identification">
                    <div>
                        @error('identification') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="flex flex-col mb-4">
                    <label class="text-sm font-bold">Nombre completo</label>
                    <input type="text" wire:model="name" class="w-full p-2 border-2 rounded-lg" id="name" name="name">
                </div>
                <div class="flex flex-col mb-4">
                    <label class="text-sm font-bold">Saldo inicial</label>
                    <input type="number" wire:model="balance" class="w-full p-2 border-2 rounded-lg" id="balance" name="balance">
                </div>
                <button type="button" wire:click="store" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg">Agregar cuenta bancaria</button>
            </form>
            
        </div>
    </div>

    <div class="w-1/2 p-2 text-left bg-blue-100 overflow-auto">
        <div class="bg-white shadow-md rounded-lg p-5">
            <h2 class="text-2xl font-bold">Listado de cuentas</h2>
            <hr class="mt-4 mb-4 pb-3">
            
            @foreach ($accounts as $account)
                <div class="flex items-center justify-between mb-4">
                    <div class="text-left">
                        <ul class="list-disc pl-4 list-none">
                            <li>{{ $account['name'] }}</li>
                        </ul>
                    </div>
                    <div class="text-right">
                        <ul class="list-disc pl-4 list-none">
                            <li>{{ $account['balance'] }}</li>
                        </ul>
                    </div>
                    <div>
                    <input type="hidden" name="from_account_id" value="{{ $account['id'] }}">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg" wire:click="fillTransferForm({{ $account['balance'] }}, {{ $account['identification'] }})">Transferir</button>
                        
                    </div>
                </div>
            @endforeach
    </div>
    <div class="bg-white shadow-md rounded-lg p-5 mt-2">
            <h2 class="text-2xl font-bold">Comenzar Transferencias</h2>
            <hr class="mt-4 mb-4 pb-3">
            
            <form wire:submit="transfer">
                
                <div class="flex flex-col mb-4">
                    <label class="text-sm font-bold">Cédula origen</label>
                    <input type="text" wire:model="root_account_id" class="w-full p-2 border-2 rounded-lg" >
                </div>
                <div class="flex flex-col mb-4">
                    <label class="text-sm font-bold">Cédula destino</label>
                    <input type="text" wire:model="destination_account_id" class="w-full p-2 border-2 rounded-lg" >
                </div>
                <div class="flex flex-col mb-4">
                    <label class="text-sm font-bold">Monto</label>
                    <input type="number" wire:model="quantity" class="w-full p-2 border-2 rounded-lg" >
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg">Aceptar</button>
            </form>
            
        </div>
        <script>
            function fillTransferForm(balance, identification) {
                @this.set('quantity', balance);
                @this.set('root_account_id', identification);
            }
        </script>
    
</div>
