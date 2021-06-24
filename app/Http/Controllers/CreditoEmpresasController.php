<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpresaParceira;
use App\Models\CreditoEmpresa;
use Redirect;

class CreditoEmpresasController extends Controller
{
    function adicionaCreditoEmpresa($id, Request $request){
        $valor = $request->input('saldo');
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $valor = floatval($valor);

        $creditoempresa = new CreditoEmpresa();
        $creditoempresa->valor = $valor;
        $creditoempresa->id_empresa = $id;
        $creditoempresa->save();

        $this->atualizaSaldoEmpresa($creditoempresa->id_empresa, $creditoempresa->valor);

        session()->flash("Mensagem", "Crédito para a empresa {$creditoempresa->empresa->razao_social} adicionado com sucesso.");
        return Redirect::back(); 
    }

    function atualizaSaldoEmpresa($id, $valor){
        $empresa = EmpresaParceira::find($id);
        $empresa->saldo += $valor;
        $empresa->save();
    }

    function listaCreditosEmpresa($id){
        $empresa = EmpresaParceira::find($id);
        $creditosempresa = CreditoEmpresa::where('id_empresa', $empresa->id)
        ->orderBy('data', 'desc')
        ->get();

        if(sizeof($creditosempresa) == 0){
            session()->flash("Retorno", "A empresa $empresa->razao_social não possuí nenhum crédito adicionado.");
            return redirect()->route('listaempresas');
        } else{
            return view('empresa_parceira/listatransacoesempresa', ['creditosempresa' => $creditosempresa]);
        }
    }
}
