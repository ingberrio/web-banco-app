<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    // Atributos que son asignables
    protected $fillable = [
        'account_id', 'transfer_id', 'previous_balance', 'new_balance',
    ];

    // Definición de las relaciones
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
