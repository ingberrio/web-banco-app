<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('costumers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->default('')->nullable();
            $table->string('phone')->nullable();
            $table->text('adress')->nullable();
            $table->string('identification')->unique()->nullable()->default(0); // Corregir aquí
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costumers');
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:costumers,email',
            'phone' => 'required|string',
            
        ]);

        $costumer = Costumer::create($data);

        return redirect()->route('costumers.index')->with('message', 'Cliente creado exitosamente.');
    }
};
