<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\EmpresaParceira;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_cliente',
        'id_categoria',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }

    function isAdmin(){
        return $this->categoria->id == 1;
    }

    function isCliente(){
        return $this->categoria->id == 2;
    }

    function isEmpresa(){
        return $this->categoria->id == 3;
    }

    function cliente(){
        return $this->hasOne(Cliente::class, 'id_user', 'id');
    }

    function empresa(){
        return $this->hasOne(EmpresaParceira::class, 'id_user', 'id');
    }

}
