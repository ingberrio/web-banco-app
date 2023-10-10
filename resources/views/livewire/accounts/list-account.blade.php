<div class="w-1/2 p-2 text-left bg-blue-100 ">
        <div class="bg-white shadow-md rounded-lg p-5 overflow-auto h-62" >
            <h2 class="text-2xl font-bold">Listado de cuentas</h2>
            <hr class="mt-4 mb-4 pb-3">
            
            @foreach ($accounts as $account)
                <div class="flex items-center justify-between mb-4 " wire:key="{{ $account->id }}">
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
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg" 
                        wire:click="fillTransferForm({{ $account['balance'] }}, {{ $account['identification'] }})" >Transferir</button>
                        
                    </div>
                </div>
            @endforeach
    </div>
    
    <script>
        Livewire.on('fillTransferForm', function(quantity, rootAccountId) {
            document.getElementById('quantity').value = quantity;
            document.getElementById('root_account_id').value = rootAccountId;
        });
    </script>
    
    
    