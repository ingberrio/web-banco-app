<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';
    protected $casts = [
        'transactions_count' => 'integer',
    ];
    protected $fillable = [
        'name',
        'identification',
        'balance',
        'transactions_count',
        'transactions_month',
        'current_month',
        'customer_id', 
        'updated_at'
    ];

    // Relación muchos a uno con el modelo Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relación uno a muchos con el modelo Balance
    public function balances()
    {
        return $this->hasMany(Balance::class);
    }

    // Relación uno a muchos con el modelo Transfer (como cuenta de origen)
    public function transfersFrom()
    {
        return $this->hasMany(Transfer::class, 'root_account_id');
    }

    // Relación uno a muchos con el modelo Transfer (como cuenta de destino)
    public function transfersTo()
    {
        return $this->hasMany(Transfer::class, 'destination_account_id');
    }
}
