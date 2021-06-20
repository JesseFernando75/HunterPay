<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacao;
use App\Models\EmpresaParceira;
use App\Models\Cliente;
use App\Models\CreditoCliente;

class TransacoesController extends Controller
{
    function cadastraTransacao(Request $request, $id){
        $valor = $request->input('valor');
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $valor = floatval($valor);

        $id_empresa = $request->input('empresa');
        $id_cliente = $id;
        $id_status = 3;
        
        $transacao = new Transacao();
        $transacao->id_cliente = $id_cliente;
        $transacao->id_empresa = $id_empresa;
        $transacao->id_status = $id_status;
        $transacao->valor = $valor;
        $transacao->save();

        $this->verificaTransacao($transacao->id);

        session()->flash("Mensagem", "Transação cadastrada com sucesso. Aguarde a confirmação.");
        return redirect()->route('listaclientes'); 
    }

     function verificaTransacao($id){
        $transacao = Transacao::findOrFail($id);
        $cliente = Cliente::findOrFail($transacao->cliente->id);
        $empresa = EmpresaParceira::findOrFail($transacao->empresa->id);

        if($transacao->valor <= $cliente->saldo){
            $cliente->saldo -= $transacao->valor;
            $empresa->saldo += $transacao->valor;
            $transacao->id_status = 1;
            $transacao->save();
            $cliente->save();
            $empresa->save();
        } else{
            $transacao->id_status = 2;
            $transacao->save();
        }
    }

    function mostraCadastroTransacao($id){
        $id_cliente = $id;
        $empresa = $this->obtemListaEmpresasTransacao();

         if(sizeof($empresa) == 0){
            session()->flash('Retorno', "Não há nenhuma empresa parceira cadastrada no momento.");
            return redirect('admin/listaclientes');
        } else{
            return view('admin/cadastrotransacao', ['empresa' => $empresa, 'id_cliente' => $id_cliente]);
        }
    }


     function obtemListaEmpresasTransacao(){
        $empresa = EmpresaParceira::all();

        $empresa = EmpresaParceira::select('id', 'razao_social')
        ->orderBy('razao_social', 'asc')
        ->get();

        return $empresa;
    }

    function listaTransacoesCliente($id){
        $cliente = Cliente::find($id);
        $creditoscliente = CreditoCliente::where('id_cliente', $cliente->id)
        ->orderBy('data', 'desc')
        ->get();
        $transacoescliente = Transacao::where('id_cliente', $cliente->id)
        ->orderBy('data', 'desc')
        ->get();

        if(sizeof($creditoscliente) == 0 && sizeof($transacoescliente) == 0){
            session()->flash("Retorno", "O cliente $cliente->nome não possuí nenhum registro de crédito.");
            return redirect()->route('listaclientes');
        } else{
            return view('cliente/listatransacoescliente', ['creditoscliente' => $creditoscliente,
                                                           'transacoescliente' => $transacoescliente]);
        }
    }

}
