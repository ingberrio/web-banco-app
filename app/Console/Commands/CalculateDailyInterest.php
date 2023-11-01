<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Account;
use Carbon\Carbon;

class CalculateDailyInterest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-daily-interest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Obtiene la fecha actual
        $today = Carbon::today();

        // Verifica si es el primer día del mes
        if ($today->day === 1) {
            // Es el primer día del mes, restablece el campo current_month y el contador de transacciones
            Account::update(['current_month' => $today->month, 'transactions_month' => 0]);
        }

        // Excluye sábados y domingos (día 6 y día 7 en Carbon)
        if ($today->dayOfWeek === 6 || $today->dayOfWeek === 7) {
            $this->info('No se aplica interés los fines de semana.');
            return;
        }

        // Todas las cuentas de la base de datos
        $accounts = Account::all();

        foreach ($accounts as $account) {
            // Verifica el tipo de cliente
            $tipoCliente = $account->tipo;

            // Aplica la tasa de interés diaria según el tipo de cliente
            $tasaDiaria = 0;
            if ($tipoCliente === 1) {
                $tasaDiaria = 0.01; // 1%
            } elseif ($tipoCliente === 2) {
                $tasaDiaria = 0.02; // 2%
            } elseif ($tipoCliente === 3) {
                $tasaDiaria = 0.03; // 3%
            }

            // Verifica el número de transacciones mensuales
            $transaccionesMensuales = $account->transactions_month;

            // Realiza ajustes en la tasa de interés según el número de transacciones
            if ($transaccionesMensuales >= 10) {
                $tasaDiaria += 0.002; // Aumenta en 0.2%
            } else {
                $tasaDiaria -= 0.002; // Disminuye en 0.2%
            }

            // Calcula el interés diario
            $interesDiario = $account->balance * $tasaDiaria;

            // Agrega el interés diario al saldo de la cuenta
            $account->balance += $interesDiario;

            // Incrementa el contador de transacciones mensuales
            $account->transactions_month++;

            // Guarda la cuenta actualizada en la base de datos
            $account->save();
        }

        $this->info('Tasas de interés diarias aplicadas con éxito.');
    }

}
