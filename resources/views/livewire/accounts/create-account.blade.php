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
                <input type="text" wire:model="name" class="w-full p-2 border-2 rounded-lg" >
            </div>
            <div class="flex flex-col mb-4">
                <label class="text-sm font-bold">Saldo inicial</label>
                <input type="number" wire:model="balance" class="w-full p-2 border-2 rounded-lg" >
            </div>
            <input type="hidden" wire:model="transactions_count" value="0">
                
            <button type="button" wire:click="store" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg">Agregar cuenta bancaria</button>
        </form>
        
    </div>
</div>
