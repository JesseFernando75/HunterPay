@extends('layouts.template')

	@section('title') Transações cliente @endsection

	@section('nav&footer')
	  	<!-- Início lista de transações -->
	  	<div class="col-8 list-group mx-auto mt-5">
		  @foreach($creditoscliente as $cv)
		  <a href="#" class="list-group-item list-group-item-action list-group-item-light flex-column align-items-start">
		    <div class="d-flex w-100 justify-content-between">
		      <small class="text-center">{{ $cv->data }}</small>
		    </div>
		    <p class="mb-1">Você recebeu uma inserção de crédito de R$ {{ $cv->valor }}</p>
		    <small>{{ $cv->id_cliente }}</small>
		  </a>
		  @endforeach
		</div>
		<!-- Fim lista de transações -->

	@endsection
        