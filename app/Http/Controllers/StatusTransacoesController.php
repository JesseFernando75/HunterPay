<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusTransacao;

class StatusTransacoesController extends Controller
{
     function cadastrar(Request $request){
        $nome = $request->input('nome');

        $transacao = new StatusTransacao();
        $transacao->nome = $nome;
        $transacao->save();
        
         return redirect()->back()->with("Mensagem", "Novo status salvo com sucesso.");  
    }
}
