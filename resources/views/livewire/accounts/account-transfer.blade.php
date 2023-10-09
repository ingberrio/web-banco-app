<div>
    <form wire:submit.prevent="transfer">
        @csrf
        <div class="flex flex-col mb-4">
            <label for="cedula-origen" class="text-sm font-bold">Cédula origen</label>
            <input wire:model="cedulaOrigen" type="text" class="w-full p-2 border-2 rounded-lg" id="root_account_id">
        </div>
        <div class="flex flex-col mb-4">
            <label for="monto" class="text-sm font-bold">Monto</label>
            <input wire:model="monto" type="number" class="w-full p-2 border-2 rounded-lg" id="balance-transfer">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg">Aceptar</button>
    </form>
</div>
