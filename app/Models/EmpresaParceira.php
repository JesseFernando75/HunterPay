<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CreditoEmpresa;
use App\Models\Transacao;
use App\Models\User;

class EmpresaParceira extends Model
{
    use HasFactory;

    protected $table = 'empresa_parceira';

    function credito(){
        return $this->hasMany(CreditoEmpresa::class, 'id_empresa', 'id');
    }

    function transacao(){
        return $this->hasMany(Transacao::class, 'id_empresa', 'id');
    }

    function user(){
        return $this->hasOne(User::class, 'id_empresa', 'id');
    }

}
