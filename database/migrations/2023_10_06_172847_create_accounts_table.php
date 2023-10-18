<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identification')->unique();
            $table->decimal('balance', 20, 2);
            $table->string('transactions_count')->default(0);
            $table->integer('transactions_month')->default(0);
            $table->integer('current_month')->default(0);
            $table->foreignId('customer_id')->nullable()
                ->constrained('customers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
