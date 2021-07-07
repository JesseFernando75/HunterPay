<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;

class ClientesController extends Controller
{

    function cadastrar(Request $request, $id){
        $nome = $request->input('nome');
        $cpf = $request->input('cpf');
        $cpf = str_replace('.', '', $cpf);
        $cpf = str_replace('-', '', $cpf);
        $cpf = floatval($cpf);
        $telefone = $request->input('telefone');

        $c1 = new Cliente();
        $c1->id_user = $id;
        $c1->nome = $nome;
        $c1->cpf = $cpf;
        $c1->telefone = $telefone;
        $c1->num_conta = rand(00001, 99999);
        $c1->saldo = 0;
    
        $c1->save();
        session()->flash("Mensagem", "Cliente cadastrado com sucesso.");
        return redirect()->route('login');
    }

    function obtemCadastroCliente($id){
        return view('cliente/cadastrocliente', ['id_user' => $id]);
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
        $cliente->cpf = str_replace('.', '', $cliente->cpf);
        $cliente->cpf = str_replace('-', '', $cliente->cpf);
        $cliente->cpf = floatval($cliente->cpf);
        $cliente->telefone = $request->input('telefone');
        $cliente->num_conta = $request->input('num_conta');

        $cliente->save();
        session()->flash("Mensagem", "O cliente {$cliente->nome} foi alterado com sucesso.");
        return redirect()->route('listaclientes'); 
    }

    function excluiCliente(Request $request){
        $id_cliente = $request->input('id_cliente');
        $cliente = Cliente::findOrFail($id_cliente);

        if($cliente->user){
            $user = User::findOrFail($cliente->user->id);
            $user->delete();
        }

        $cliente->delete();
        session()->flash("Mensagem", "Excluído com sucesso.");
        return redirect()->route('listaclientes');  
    }

}
