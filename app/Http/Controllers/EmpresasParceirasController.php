<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpresaParceira;

class EmpresasParceirasController extends Controller
{
    function cadastrar(Request $request){
        $razao_social = $request->input('razao_social');
        $cnpj = $request->input('cnpj');
        $telefone = $request->input('telefone');

        $e1 = new EmpresaParceira();
        $e1->razao_social = $razao_social;
        $e1->cnpj = $cnpj;
        $e1->telefone = $telefone;
        $e1->token = bin2hex(random_bytes(8));
        $e1->num_conta = rand(00001, 99999);
        $e1->saldo = 0;
    
        $e1->save();
        return view('empresa_parceira/cadastroempresalogin', ['empresa' => $e1]);
    }
}
