@extends('layouts.template')

    @section('title') Acesso negado @endsection

    @section('estilo')

    @endsection

    @section('nav&footer')
    <!-- Texto principal -->
        <div class="d-flex justify-content-center align-items-center" style="height: 700px;">
            <div class="text-center">
                <h1 class="text-light">Acesso <span style="color: #f9f871;">negado.</span></h1>
                <p class="text-muted">Desculpe, você não permissão para acessar esta página.</p>
            </div>
        </div>
    <!-- Fim texto principal -->
    @endsection