<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmpresaParceira;

class CreditoEmpresa extends Model
{
    use HasFactory;

    protected $table = 'credito_empresa';

    function empresa(){
        return $this->belongsTo(EmpresaParceira::class, 'id_empresa', 'id');
    }

}
