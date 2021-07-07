<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpresaParceira;
use App\Models\User;

class EmpresasParceirasController extends Controller
{
    function cadastrar(Request $request, $id){
        $razao_social = $request->input('razao_social');
        $cnpj = $request->input('cnpj');
        $cnpj = str_replace('.', '', $cnpj);
        $cnpj = str_replace('/', '', $cnpj);
        $cnpj = str_replace('-', '', $cnpj);
        $cnpj = floatval($cnpj);
        $telefone = $request->input('telefone');

        $e1 = new EmpresaParceira();
        $e1->id_user = $id;
        $e1->razao_social = $razao_social;
        $e1->cnpj = $cnpj;
        $e1->telefone = $telefone;
        $e1->token = bin2hex(random_bytes(8));
        $e1->num_conta = rand(00001, 99999);
        $e1->saldo = 0;
    
        $e1->save();
        session()->flash("Mensagem", "Empresa Parceira cadastrado com sucesso.");
        return redirect()->route('login');
    }

    function obtemCadastroEmpresa($id){
        return view('empresa_parceira/cadastroempresa', ['id_user' => $id]);
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
        $empresa->cnpj = str_replace('.', '', $empresa->cnpj);
        $empresa->cnpj = str_replace('/', '', $empresa->cnpj);
        $empresa->cnpj = str_replace('-', '', $empresa->cnpj);
        $empresa->cnpj = floatval($empresa->cnpj);
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

        if($empresa->user){
            $user = User::findOrFail($empresa->user->id);
            $user->delete();
        }

        $empresa->delete();
        session()->flash("Mensagem", "Excluído com sucesso.");
        return redirect()->route('listaempresas'); 
    }

}
