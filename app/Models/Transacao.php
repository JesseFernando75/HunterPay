<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\EmpresaParceira;
use App\Models\StatusTransacao;

class Transacao extends Model
{
    use HasFactory;

    protected $table = 'transacao';

    function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }

    function empresa(){
        return $this->belongsTo(EmpresaParceira::class, 'id_empresa', 'id');
    }

    function status(){
        return $this->belongsTo(StatusTransacao::class, 'id_status', 'id');
    }
}
