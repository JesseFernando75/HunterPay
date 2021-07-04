@extends('layouts.template')

	@section('title') Transações empresa @endsection

	@section('nav&footer')

	<!-- Início card saldo -->
	<div class="col-8 card text-center text-white mx-auto mt-4" style="background-color: #616161;">
	  <div class="card-body">
	    <h5 class="card-title">Saldo disponível</h5>
	    <p class="card-text fs-5">R$ &nbsp;
	    	<span class="text-success fs-1">{{ number_format($empresa->saldo, 2, ',', '.') }}</span>
	    </p>
	  </div>
	</div>
	<!-- Fim card saldo -->

	<!-- Início lista de transações -->
	<p class="text-center text-light font-weight-bold fs-4 mt-4">Transações efetuadas</p>
	 @if(sizeof($transacoesempresa) == 0)
	  <p class="text-center text-danger fs-6">Nenhuma transação até o momento.</p>
	 @else
		<div class="col-8 list-group mx-auto mt-1">
		  @foreach($transacoesempresa as $tc)
		  <div class="list-group-item text-light" style="background-color: #616161;">
		    <div class="d-flex w-100 justify-content-between">
		    	@if($tc->id_status == 1)
		      		<h6 class="text-success">{{ $tc->status->nome }}</h6>
		      	@elseif($tc->id_status == 2)
		      		<h6 class="text-danger">{{ $tc->status->nome }}</h6>
		      	@else
		      		<h6 class="text-warning">{{ $tc->status->nome }}</h6>
		      	@endif
		      <small>{{ $tc->data }}</small>
		    </div>
		    <p class="mb-1">Você recebeu uma transação de R$ {{ number_format($tc->valor, 2, ',', '.') }}</p>
		    	@if($tc->cliente)
		      		<small>{{ $tc->cliente->nome }}</small>
		      	@else
		    		<small>Nome do cliente não encontrado</small>
		    	@endif
		  </div>
		  @endforeach
		</div>
	@endif
	<!-- Fim lista de transações -->

	<!-- Início lista de créditos -->
	<p class="text-center text-light font-weight-bold fs-4 mt-4">Créditos recebidos</p>
	 @if(sizeof($creditosempresa) == 0)
	  <p class="text-center text-danger fs-6 mb-5">Nenhum crédito recebido até o momento.</p>
	 @else
		<div class="col-8 list-group mx-auto mt-1 mb-5">
		  @foreach($creditosempresa as $cv)
		   <div class="list-group-item text-light" style="background-color: #616161;">
		    <div class="d-flex w-100 justify-content-between">
		      	<h6 class="text-success">Recebido</h6>
		      <small>{{ $cv->data }}</small>
		    </div>
		    <p class="mb-1">Você recebeu créditos de R$ {{ number_format($cv->valor, 2, ',', '.') }}</p>
		    	<small>Admin</small>
		  </div>
		  @endforeach
		</div>
	@endif
	<!-- Fim lista de créditos -->

	@endsection