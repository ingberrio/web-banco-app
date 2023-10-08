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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->decimal('quantity', 10, 2)->nullable()->default(null);
            $table->foreignId('root_account_id')
                ->constrained('accounts')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('destination_account_id')
                ->constrained('accounts')
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
        Schema::dropIfExists('transfers');
    }
};
