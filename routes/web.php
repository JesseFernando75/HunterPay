<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EmpresasParceirasController;

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
Route::get('/cadastro/empresa', function() {
        return view('empresa_parceira/cadastroempresa');
    })->name('cadastroempresa');

Route::post('/cadastro/empresa/adicionar', [EmpresasParceirasController::class, 'cadastrar'])->name('cadastrarempresa');
//Fim Empresa parceira

//Cliente
Route::get('/cadastro/cliente', function() {
        return view('cliente/cadastrocliente');
    })->name('cadastrocliente');

Route::post('/cadastro/cliente/adicionar', [ClientesController::class, 'cadastrar'])->name('cadastrarcliente');
//Fim Cliente

Route::middleware('auth')->group(function(){

    //Admin
    Route::middleware('is_admin')->group(function(){

        Route::get('/admin/listaclientes', [ClientesController::class, 'obtemListaClientes'])->name('listaclientes');

        Route::get('/admin/bem-vindo', function() {
            return view('/admin/inicial');
        })->name('bemvindo');

    });
    //Fim Admin

});

Auth::routes();