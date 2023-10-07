<x-layouts.app>
    <div class="flex mb-4">
        <div class="w-1/2 p-2 text-left bg-blue-200 ">
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
                    @csrf
                    <div class="flex flex-col mb-4">
                        <label for="identification" class="text-sm font-bold">Cédula</label>
                        <input type="text" wire:model="identification" class="w-full p-2 border-2 rounded-lg" name="identification" id="identification">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="name" class="text-sm font-bold">Nombre completo</label>
                        <input type="text" wire:model="name" class="w-full p-2 border-2 rounded-lg" id="name" name="name">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="balance" class="text-sm font-bold">Saldo inicial</label>
                        <input type="number" wire:model="balance" class="w-full p-2 border-2 rounded-lg" id="balance" name="balance">
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg">Agregar cuenta bancaria</button>
                </form>
                
            </div>
        </div>

        <div class="w-1/2 p-2 text-left bg-blue-200 overflow-auto">
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
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg" onclick="fillTransferForm({{ $account['balance'] }}, {{ $account['identification'] }})">Transferir</button>
                          
                        </div>
                    </div>
                @endforeach

            <div class="bg-white shadow-md rounded-lg p-5 mt-2">
                <h2 class="text-2xl font-bold">Comenzar Transferencias</h2>
                <hr class="mt-4 mb-4 pb-3">
                <div class="w-full p-2 text-center">
                    @if (session()->has('message'))
                        <div class="bg-green-500 text-white p-2 rounded-lg">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <form wire:submit.prevent="transfer">
                    @csrf
                    <div class="flex flex-col mb-4">
                        <label for="cedula-origen" class="text-sm font-bold">Cédula origen</label>
                        <input type="text" wire:model="root_account_id" class="w-full p-2 border-2 rounded-lg" id="root_account_id" name="root_account_id">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="cedula-destino" class="text-sm font-bold">Cédula destino</label>
                        <input type="text" wire:model="destination_account_id" class="w-full p-2 border-2 rounded-lg" id="destination_account_id" name="destination_account_id">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="monto" class="text-sm font-bold">Monto</label>
                        <input type="number" wire:model="quantity" class="w-full p-2 border-2 rounded-lg" id="quantity" name="quantity">
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg">Aceptar</button>
                </form>
                
            </div>
            <script>
                function fillTransferForm(balance, identification) {
                    document.getElementById('quantity').value = balance;
                    document.getElementById('root_account_id').value = identification;
                }
            </script>
        </div>
        
    </div>
</x-layouts.app>