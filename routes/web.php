<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EmpresasParceirasController;
use App\Http\Controllers\CreditoClientesController;
use App\Http\Controllers\CreditoEmpresasController;
use App\Http\Controllers\StatusTransacoesController;
use App\Http\Controllers\TransacoesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Home
Route::get('/home', function () {
    return view('welcome');
})->name('home');
//Fim Home

//Login
Route::get('/login', function() {
    return view('login');
})->name('login');
//Fim Login

//Empresa parceira
Route::get('/cadastro/empresa/login', function() {
        return view('empresa_parceira/cadastroempresalogin');
    })->name('cadastroempresalogin');

Route::get('/cadastro/empresa/{id_user}', [EmpresasParceirasController::class, 'obtemCadastroEmpresa'])->name('cadastroempresa');

Route::post('/cadastro/empresa/adicionar/{id}', [EmpresasParceirasController::class, 'cadastrar'])->name('cadastrarempresa');
//Fim Empresa parceira

//Cliente
Route::get('/cadastro/cliente/login', function() {
        return view('cliente/cadastroclientelogin');
    })->name('cadastroclientelogin');

Route::get('/cadastro/cliente/{id_user}', [ClientesController::class, 'obtemCadastroCliente'])->name('cadastrocliente');

Route::post('/cadastro/cliente/adicionar/{id}', [ClientesController::class, 'cadastrar'])->name('cadastrarcliente');
//Fim Cliente

Route::middleware('auth')->group(function(){
    //Cliente
    Route::get('cliente/listadetransacoes/{id}', [TransacoesController::class, 'listaTransacoesCliente'])->name('transacoesdecliente');
    //Fim Cliente

    //Empresa Parceira
    Route::get('empresa/listadetransacoes/{id}', [TransacoesController::class, 'listaTransacoesEmpresa'])->name('transacoesdeempresa');
    //Fim Empresa Parceira

    //Admin
    Route::middleware('is_admin')->group(function(){

        Route::get('/admin/listaclientes', [ClientesController::class, 'obtemListaClientes'])->name('listaclientes');

        Route::get('/admin/listaempresas', [EmpresasParceirasController::class, 'obtemListaEmpresas'])->name('listaempresas');

        Route::get('/admin/bem-vindo', function() {
            return view('/admin/bemvindo');
        })->name('bemvindo');

        Route::post('admin/cliente/alterar/{id}', [ClientesController::class, 'editar'])->name('editarcliente');

        Route::get('admin/cliente/editar/{id}', [ClientesController::class, 'editaCliente'])->name('editacliente');

        Route::post('admin/empresa/alterar/{id}', [EmpresasParceirasController::class, 'editar'])->name('editarempresa');

        Route::get('admin/empresa/editar/{id}', [EmpresasParceirasController::class, 'editaEmpresa'])->name('editaempresa');

        Route::post('admin/cliente/excluir', [ClientesController::class, 'excluiCliente'])->name('excluicliente');

        Route::post('admin/empresa/excluir', [EmpresasParceirasController::class, 'excluiEmpresa'])->name('excluiempresa');

        Route::post('admin/cliente/credito/{id}', [CreditoClientesController::class, 'adicionaCreditoCliente'])->name('adicionarcreditocliente');

        Route::get('admin/cliente/listadetransacoes/{id}', [TransacoesController::class, 'listaTransacoesCliente'])->name('transacoescliente');

        Route::get('/admin/transacao/cadastro/{id}', [TransacoesController::class, 'mostraCadastroTransacao'])->name('cadastrotransacaoauxiliar');

        Route::post('admin/transacao/status/adicionar', [StatusTransacoesController::class, 'cadastrar'])->name('cadastrarstatustransacao');

        Route::post('admin/transacao/cadastrar/{id}', [TransacoesController::class, 'cadastraTransacao'])->name('cadastratransacao');

        Route::post('admin/empresa/credito/{id}', [CreditoEmpresasController::class, 'adicionaCreditoEmpresa'])->name('adicionarcreditoempresa');

        Route::get('admin/empresa/listadetransacoes/{id}', [TransacoesController::class, 'listaTransacoesEmpresa'])->name('transacoesempresa');

    });
    //Fim Admin
    
});

Auth::routes();