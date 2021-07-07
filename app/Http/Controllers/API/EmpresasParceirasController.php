<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmpresaParceira;

class EmpresasParceirasController extends Controller
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

        $empresa = new EmpresaParceira();
        $empresa->id_user = 0;
        $empresa->razao_social = $dados->razao_social;
        $empresa->cnpj = $dados->cnpj;
        $empresa->telefone = $dados->telefone;
        $empresa->token = bin2hex(random_bytes(8));
        $empresa->num_conta = rand(00001, 99999);
        $empresa->saldo = 0;
        $empresa->save();

        return $empresa;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        return $empresa = EmpresaParceira::where('token', $token)->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $token)
    {

        $empresa = EmpresaParceira::where('token', $token)->firstOrFail();

        $dados = json_decode($request->getContent());
        $empresa->razao_social = $dados->razao_social;
        $empresa->cnpj = $dados->cnpj;
        $empresa->telefone = $dados->telefone;
        $empresa->save();

        return $empresa;
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
