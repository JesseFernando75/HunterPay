<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class CreditoCliente extends Model
{
    use HasFactory;

    protected $table = 'credito_cliente';

     function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }
}
