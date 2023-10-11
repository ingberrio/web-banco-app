
<div class="bg-white shadow-md rounded-lg p-5 mt-2">

    <h2 class="text-2xl font-bold">Comenzar Transferencias</h2>
    <hr class="mt-4 mb-4 pb-3">
    
    <div id="transfer-form-container" wire:ignore>
        <form wire:submit="transfer" >
            @csrf
            <div class="flex flex-col mb-4">
                <label class="text-sm font-bold">Cédula origen</label>
                <input type="text" wire:model="root_account_id" id="root_account_id"  class="w-full p-2 border-2 rounded-lg" >
            </div>
            <div class="flex flex-col mb-4">
                <label class="text-sm font-bold">Cédula destino</label>
                <input type="text" wire:model="destination_account_id"  id="destination_account_id"  class="w-full p-2 border-2 rounded-lg" >
            </div>
            <div class="flex flex-col mb-4">
                <label class="text-sm font-bold">Monto</label>
                <input type="number" wire:model="quantity"  id="quantity" class="w-full p-2 border-2 rounded-lg" >
            </div>

            <button wire:click.prevent="transfer" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg" >Aceptar</button>
        </form>
    </div>
  
</div>


