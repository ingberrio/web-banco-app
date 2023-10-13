<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    // Atributos que son asignables en masa
    protected $fillable = [
        'account_id', 'transfer_id', 'amount', 'date',
    ];

    // Definición de las relaciones
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
