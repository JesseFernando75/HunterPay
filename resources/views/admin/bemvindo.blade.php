@extends('layouts.template')

	@section('title') Bem-vindo @endsection

	@section('nav&footer')
    
    <!-- Início mensagem alterar -->
        @if(session('Mensagem'))
            <div class="row">
                <div class="alert alert-success text-center py-3">
                    {{ session('Mensagem') }}
                </div>
            </div>
        @endif

        @if(session('Retorno'))
            <div class="row">
                <div class="alert alert-danger text-center py-3">
                    {{ session('Retorno') }}
                </div>
            </div>
        @endif
    <!-- Fim mensagem alterar -->

	<!-- Texto principal -->
        <div class="d-flex justify-content-center align-items-center" style="height: 700px;">
            <div class="text-center">
                <h1 class="text-light">Bem-<span style="color: #f9f871;">vindo</span></h1>
            </div>
        </div>
    <!-- Fim texto principal -->
	@endsection