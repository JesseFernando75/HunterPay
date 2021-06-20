<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CreditoCliente;
use App\Models\Cliente;
use DB;

class CreditoClientesController extends Controller
{
    
    function adicionaCreditoCliente(Request $request, $id){
        $valor = $request->input('saldo');
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $valor = floatval($valor);

        $creditocliente = new CreditoCliente();
        $creditocliente->valor = $valor;
        $creditocliente->id_cliente = $id;
        $creditocliente->save();

        $this->atualizaSaldoCliente($creditocliente->id_cliente, $creditocliente->valor);

        session()->flash("Mensagem", "Crédito para o cliente {$creditocliente->cliente->nome} adicionado com sucesso.");
        return redirect()->route('listaclientes'); 
    }

    function atualizaSaldoCliente($id, $valor){
        $cliente = Cliente::find($id);
        $cliente->saldo += $valor;
        $cliente->save();
    }

    function listaCreditosCliente($id){
        $cliente = Cliente::find($id);
        $creditoscliente = CreditoCliente::where('id_cliente', $cliente->id)
        ->orderBy('data', 'desc')
        ->get();

        if(sizeof($creditoscliente) == 0){
            session()->flash("Retorno", "O cliente $cliente->nome não possuí nenhum crédito adicionado.");
            return redirect()->route('listaclientes');
        } else{
            return view('cliente/listatransacoescliente', ['creditoscliente' => $creditoscliente]);
        }
    }
}
