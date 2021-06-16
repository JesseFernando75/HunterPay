@extends('layouts.template')

	@section('title') Clientes @endsection

	@section('estilo')

		th, td{
			text-align: center;
		}

	@endsection

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

	  	<!-- Início tabela -->
	  	<ul class="nav nav-tabs mx-auto mt-5">
		  <li class="nav-item">
		    <a class="nav-link active" aria-current="page" href="#">Clientes</a>
				<table class="table col-12">
					<thead>
						<tr class="text-light">
						    <th scope="col">Código</th>
						    <th scope="col">Nome</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						@foreach($cliente as $v)
						<tr class="text-light">
						    <td>{{ $v->id }}</td>
							<td>{{ $v->nome }}</td>
							<td>
							<a href="#" class="btn btn-info">Alterar</a>
							<a href="#" data-bs-toggle="modal" data-bs-target="#exclusao" class="btn btn-danger" {{ $identificador = $v->id }} >Excluir</a>
							<a href="#" class="btn btn-light">Compras</a>
							<a href="#" class="btn btn-warning">Nova compra</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<a href="#" class="btn mb-5 btn-light">Novo Cadastro</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="#">Empresas parceiras</a>
		    <table class="table col-12">
					<thead>
						<tr class="text-light">
						    <th scope="col">Código</th>
						    <th scope="col">Nome</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						@foreach($cliente as $v)
						<tr class="text-light">
						    <td>{{ $v->id }}</td>
							<td>{{ $v->nome }}</td>
							<td>
							<a href="#" class="btn btn-info">Alterar</a>
							<a href="#" data-bs-toggle="modal" data-bs-target="#exclusao" class="btn btn-danger" {{ $identificador = $v->id }} >Excluir</a>
							<a href="#" class="btn btn-light">Compras</a>
							<a href="#" class="btn btn-warning">Nova compra</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<a href="#" class="btn mb-5 btn-light">Novo Cadastro</a>
		  </li>
		</ul>
		<!-- Fim modal de confirmação -->

	@endsection