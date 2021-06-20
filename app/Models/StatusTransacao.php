<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transacao;

class StatusTransacao extends Model
{
    use HasFactory;

    protected $table = 'status_transacao';

    function transacao(){
        return $this->hasMany(Transacao::class, 'id_status', 'id');
    }
}
