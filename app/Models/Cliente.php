<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    
    function categoria(){
    	return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }
}
