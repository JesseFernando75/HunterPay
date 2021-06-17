<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CreditoCliente;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

     function credito(){
        return $this->hasMany(CreditoCliente::class, 'id_cliente', 'id');
    }
}
