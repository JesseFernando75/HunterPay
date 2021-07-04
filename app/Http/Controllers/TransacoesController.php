<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacao;
use App\Models\EmpresaParceira;
use App\Models\Cliente;
use App\Models\CreditoCliente;
use App\Models\CreditoEmpresa;
use Auth;

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

    function listaTransacoesCliente($id){
        if(Auth::user()->isAdmin() || Auth::user()->cliente->id == $id){
            $cliente = Cliente::findOrFail($id);
            $creditoscliente = CreditoCliente::where('id_cliente', $cliente->id)
            ->orderBy('data', 'desc')->get();
            $transacoescliente = Transacao::where('id_cliente', $cliente->id)
            ->orderBy('data', 'desc')->get();
 
            return view('cliente/listatransacoescliente', ['cliente' => $cliente,
                                                           'creditoscliente' => $creditoscliente,
                                                           'transacoescliente' => $transacoescliente]);
        } else{
            return view('admin/acessonegado');
        }
    }

     function obtemListaEmpresasTransacao(){
        $empresa = EmpresaParceira::all();

        $empresa = EmpresaParceira::select('id', 'razao_social')
        ->orderBy('razao_social', 'asc')->get();

        return $empresa;
    }

    function listaTransacoesEmpresa($id){
        if(Auth::user()->isAdmin() || Auth::user()->empresa->id == $id){
            $empresa = EmpresaParceira::find($id);
            $creditosempresa = CreditoEmpresa::where('id_empresa', $empresa->id)
            ->orderBy('data', 'desc')->get();
            $transacoesempresa = Transacao::where('id_empresa', $empresa->id)
            ->orderBy('data', 'desc')->get();

            return view('empresa_parceira/listatransacoesempresa', ['empresa' => $empresa,
                                                                    'creditosempresa' => $creditosempresa,
                                                                    'transacoesempresa' => $transacoesempresa]);
            } else{
            return view('admin/acessonegado');
        }
    }
    
}
