@extends('layouts.template')

    @section('title') Acesso negado @endsection

    @section('estilo')

    @endsection

    @section('nav&footer')
        <!-- Texto principal -->
        <div class="row">
            <div class="alert alert-danger text-center py-4">
                Desculpe, você não tem permissão para acessar esta página.         
            </div>
        </div>

        <!-- Fim Texto principal -->
    @endsection