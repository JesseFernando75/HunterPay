@extends('layouts.template')

	@section('title') Transações cliente @endsection

	@section('nav&footer')

	<!-- Início lista de créditos -->
		<div class="col-8 list-group mx-auto mt-5 mb-5">
		  @foreach($transacoescliente as $tc)
		  <div class="list-group-item text-light" style="background-color: #616161;">
		    <div class="d-flex w-100 justify-content-between">
		    	@if($tc->id_status == 1)
		      		<h6 class="mb-1 text-success">{{ $tc->status->nome }}</h6>
		      	@elseif($tc->id_status == 2)
		      		<h6 class="mb-1 alert text-danger">{{ $tc->status->nome }}</h6>
		      	@else
		      		<h6 class="mb-1 text-warning">{{ $tc->status->nome }}</h6>
		      	@endif
		      <small>{{ $tc->data }}</small>
		    </div>
		    <p class="mb-1">Você fez uma transação de R$ {{ number_format($tc->valor, 2, ',', '.') }}</p>
		    <small>{{ $tc->empresa->razao_social }}</small>
		  </div>
		  @endforeach
		</div>
	<!-- Fim lista de créditos -->

	<!-- Início lista de créditos -->
		<div class="col-8 list-group mx-auto mt-5 mb-5">
		  @foreach($creditoscliente as $cv)
		  <div class="list-group-item text-light" style="background-color: #616161;">
		    <div class="d-flex w-100 justify-content-between">
		      <h5 class="mb-1"></h5>
		      <small>{{ $cv->data }}</small>
		    </div>
		    <p class="mb-1">Você recebeu um crédito de R$ {{ number_format($cv->valor, 2, ',', '.') }}</p>
		    <small>Admin</small>
		  </div>
		  @endforeach
		</div>
	<!-- Fim lista de créditos -->

	@endsection
        