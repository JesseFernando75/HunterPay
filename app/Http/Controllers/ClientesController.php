<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClientesController extends Controller
{

    function cadastrar(Request $request){
        $nome = $request->input('nome');
        $cpf = $request->input('cpf');
        $telefone = $request->input('telefone');

        $c1 = new Cliente();
        $c1->nome = $nome;
        $c1->cpf = $cpf;
        $c1->telefone = $telefone;
        $c1->num_conta = rand(00001, 99999);
        $c1->saldo = 0;
    
        $c1->save();
        return view('cliente/cadastroclientelogin', ['cliente' => $c1->id]);
    }

    function obtemListaClientes(){
        $cliente = Cliente::all();
        return view('admin/listaclientes', ['cliente' => $cliente]);
    }

}
