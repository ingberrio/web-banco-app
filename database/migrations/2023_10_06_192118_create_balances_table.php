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
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')
                    ->constrained('accounts')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            $table->foreignId('transfer_id')
                ->constrained('transfers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->decimal('previous_balance', 20, 2);
            $table->decimal('new_balance', 20, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('balances');
    }
};
