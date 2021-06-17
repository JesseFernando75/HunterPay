<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CreditoEmpresa;

class EmpresaParceira extends Model
{
    use HasFactory;

    protected $table = 'empresa_parceira';

    function credito(){
        return $this->hasMany(CreditoEmpresa::class, 'id_empresa', 'id');
    }
}
