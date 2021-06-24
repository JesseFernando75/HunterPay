<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpresaParceira;
use App\Models\User;

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
        return view('empresa_parceira/cadastroempresalogin', ['id_empresa' => $e1->id]);
    }

    function obtemListaEmpresas(){
        $empresa = EmpresaParceira::select()
        ->orderBy('razao_social', 'asc')->get();

        if(sizeof($empresa) == 0){
            session()->flash('Retorno', "Não há nenhuma empresa parceira cadastrada no momento.");
            return redirect()->route('bemvindo');
        } else{
            return view('admin/listaempresas', ['empresa' => $empresa]);
        }
    }

     function editaEmpresa($id){
        $empresa = EmpresaParceira::find($id);
        return view('empresa_parceira/editarempresa', ['e' => $empresa]);
    }

    function editar(Request $request, $id){
        $empresa = EmpresaParceira::find($id);

        $empresa->razao_social = $request->input('razao_social');
        $empresa->cnpj = $request->input('cnpj');
        $empresa->telefone = $request->input('telefone');
        $empresa->token = $request->input('token');
        $empresa->num_conta = $request->input('num_conta');

        $empresa->save();
        session()->flash("Mensagem", "A empresa {$empresa->razao_social} foi alterada com sucesso.");
        return redirect()->route('listaempresas'); 
    }

    function excluiEmpresa(Request $request){
        $id_empresa = $request->input('id_empresa');
        $empresa = EmpresaParceira::findOrFail($id_empresa);
        $user = User::findOrFail($empresa->user->id);

        $empresa->delete();
        $user->delete();
        session()->flash("Mensagem", "Excluído com sucesso.");
        return redirect()->route('listaempresas'); 
    }

}
