<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $table = 'transfers';
    protected $fillable = ['quantity', 'root_account_id', 'destination_account_id'];

    public function rootAccount()
    {
        return $this->belongsTo(Account::class, 'root_account_id');
    }
}
