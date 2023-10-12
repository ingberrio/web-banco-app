<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class Costumer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'identification', 'costumer_id'];
    //add norequired email

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

}
