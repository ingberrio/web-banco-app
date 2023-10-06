<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>Admin accounts</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex mb-4">
        <div class="w-1/2 p-2 text-left bg-blue-200 ">
            <div class="bg-white shadow-md rounded-lg p-5">
                <h1 class="text-2xl font-bold">Creación de cuentas</h1>
                <hr class="mt-4 mb-4 pb-3">
                
                <form action="#">
                    <div class="flex flex-col mb-4">
                        <label for="cedula" class="text-sm font-bold">Cédula</label>
                        <input type="text" class="w-full p-2 border-2 rounded-lg" id="cedula">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="nombre-completo" class="text-sm font-bold">Nombre completo</label>
                        <input type="text" class="w-full p-2 border-2 rounded-lg" id="nombre-completo">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="saldo-inicial" class="text-sm font-bold">Saldo inicial</label>
                        <input type="number" class="w-full p-2 border-2 rounded-lg" id="saldo-inicial">
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg">Agregar cuenta bancaria</button>
                </form>
            </div>
        </div>

        <div class="w-1/2 p-2 text-left bg-blue-200">
            <div class="bg-white shadow-md rounded-lg p-5">
                <h2 class="text-2xl font-bold">Listado de cuentas</h2>
                <hr class="mt-4 mb-4 pb-3">
                
                <u class="list-disc pl-4 list-none" >
                    <li>Juan Camilo Jaramillo $100.000</li>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg">Transferir</button>
                </ul>
            </div>

            <div class="bg-white shadow-md rounded-lg p-5 mt-2">
                <h2 class="text-2xl font-bold">Listado de cuentas</h2>
                <hr class="mt-4 mb-4 pb-3">
                
                <form action="#">
                    <div class="flex flex-col mb-4">
                        <label for="cedula-origen" class="text-sm font-bold">Cédula origen</label>
                        <input type="text" class="w-full p-2 border-2 rounded-lg" id="cedula-origen">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="cedula-destino" class="text-sm font-bold">Cédula destino</label>
                        <input type="text" class="w-full p-2 border-2 rounded-lg" id="cedula-destino">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="monto" class="text-sm font-bold">Monto</label>
                        <input type="number" class="w-full p-2 border-2 rounded-lg" id="monto">
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-lg">Aceptar</button>
                </form>
            </div>
        </div>
  </div>
</body>
</html>
