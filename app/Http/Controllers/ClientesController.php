<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;

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
        return view('cliente/cadastroclientelogin', ['id_cliente' => $c1->id]);
    }

    function obtemListaClientes(){
        $cliente = Cliente::select()
        ->orderBy('nome', 'asc')->get();

        if(sizeof($cliente) == 0){
            session()->flash("Retorno", "Não há nenhum cliente cadastrado no momento.");
            return redirect()->route('bemvindo'); 
        } else{
            return view('admin/listaclientes', ['cliente' => $cliente]);
        }
    }

    function editaCliente($id){
        $cliente = Cliente::find($id);
        return view('cliente/editarcliente', ['v' => $cliente]);
    }

    function editar(Request $request, $id){
        $cliente = Cliente::find($id);

        $cliente->nome = $request->input('nome');
        $cliente->cpf = $request->input('cpf');
        $cliente->telefone = $request->input('telefone');
        $cliente->num_conta = $request->input('num_conta');

        $cliente->save();
        session()->flash("Mensagem", "O cliente {$cliente->nome} foi alterado com sucesso.");
        return redirect()->route('listaclientes'); 
    }

    function excluiCliente(Request $request){
        $id_cliente = $request->input('id_cliente');
        $cliente = Cliente::findOrFail($id_cliente);
        $user = User::findOrFail($cliente->user->id);

        $cliente->delete();
        $user->delete();
        session()->flash("Mensagem", "Excluído com sucesso.");
        return redirect()->route('listaclientes');  
    }

}
