<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CreditoCliente;
use App\Models\Transacao;
use App\Models\User;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

     function credito(){
        return $this->hasMany(CreditoCliente::class, 'id_cliente', 'id');
    }

    function transacao(){
        return $this->hasMany(Transacao::class, 'id_cliente', 'id');
    }

     function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
