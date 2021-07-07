<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transacao;
use App\Models\Cliente;
use App\Models\EmpresaParceira;
use App\Models\CreditoCliente;


class TransacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = json_decode($request->getContent());

        $cpf = $dados->cpf;
        $valor = $dados->valor;
        $token = $dados->token;
        $empresa = EmpresaParceira::where('token', $token)->firstOrFail();

        if($empresa){
            $cliente = Cliente::where('cpf', $cpf)->first();

            if($cliente){
                $id_status = 3;

                $transacao = new Transacao();
                $transacao->id_cliente = $cliente->id;
                $transacao->id_empresa = $empresa->id;
                $transacao->id_status = $id_status;
                $transacao->valor = $valor;
                $transacao->save();

                return $this->verificaTransacao($transacao->id);

            } else{
                $c1 = new Cliente();
                $c1->id_user = 0;
                $c1->nome = "";
                $c1->cpf = $cpf;
                $c1->telefone = "";
                $c1->num_conta = rand(00001, 99999);
                $c1->saldo = 0;
                $c1->save();

                $this->adicionaCreditoCliente($c1->id);
                $id_status = 3;
                $transacao = new Transacao();
                $transacao->id_cliente = $c1->id;
                $transacao->id_empresa = $empresa->id;
                $transacao->id_status = $id_status;
                $transacao->valor = $valor;
                $transacao->save();

                return $this->verificaTransacao($transacao->id);
            }
        } 
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

            return $transacao->status->nome;
        } else{
            $transacao->id_status = 2;
            $transacao->save();

            return $transacao->status->nome;
        }
    }

    function adicionaCreditoCliente($id){
        $creditocliente = new CreditoCliente();
        $creditocliente->valor = 50.00;
        $creditocliente->id_cliente = $id;
        $creditocliente->save();

        $cliente = Cliente::findOrFail($id);
        $cliente->saldo += $creditocliente->valor;
        $cliente->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $empresa = EmpresaParceira::where('token', $token)->firstOrFail();
        return Transacao::where('id_empresa', $empresa->id)
        ->orderBy('data', 'desc')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
