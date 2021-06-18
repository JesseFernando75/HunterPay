<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';

    function cliente(){
        	return $this->hasMany(Cliente::class, 'id_categoria', 'id');
        }
}
