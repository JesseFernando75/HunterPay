@extends('layouts.template')

	@section('scripts')
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
	@endsection

	@section('title') Lista de clientes @endsection

	@routes
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
	  	<div class="row">
	  		<div class="col-lg-9 col-md-9 col-sm-10 col-xs-10 mx-auto mt-5">
			  	<table class="table table-responsive-sm col-12">
				  <thead>
				    <tr class="text-light">
				      <th scope="col">Código</th>
				      <th scope="col">Nome</th>
				      <th scope="col">CPF</th>
				      <th scope="col">Conta</th>
				      <th scope="col">Saldo</th>
				      <th scope="col">Opções</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      	@foreach($cliente as $v)
				      		<tr class="text-light">
				      			<td>{{ $v->id }}</td>
					      		<td>{{ $v->nome }}</td>
					      		<td>{{ $v->cpf }}</td>
					      		<td>{{ $v->num_conta }}</td>
					      		<td>R$ {{ number_format($v->saldo, 2, ',', '.') }}</td>
					      		<td>
					      			<a href="{{ route('editacliente', ['id' => $v->id]) }}" class="btn btn-info btn-sm">Alterar</a>
					      			<a href="#" data-bs-toggle="modal" data-bs-target="#exclusao" class="btn btn-danger btn-sm">Excluir</a>
					      			<a href="{{ route('transacoescliente', ['id' => $v->id]) }}" class="btn btn-light btn-sm">Transações</a>
					      			<a href="#" data-bs-toggle="modal" data-bs-target="#adicionacredito" class="btn btn-warning btn-sm" onclick="adicionaCreditoClienteId({{ $v->id }}")>Crédito</a>
					      			<a href="{{ route('cadastrotransacaoauxiliar', ['id' => $v->id]) }}" class="btn btn-success btn-sm">Transferir</a>
					      		</td>
				      	    </tr>
				        @endforeach
				  </tbody>
				</table>
				<a href="#" class="btn mb-5 btn-light">Novo cliente</a>
			</div>
		</div>
		<!-- Fim tabela -->	

		<!-- Modal de confirmação de exclusão -->
		<div class="modal fade" id="exclusao" tabindex="-1" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Excluir</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        Você realmente deseja excluir este cadastro? Essa ação é irreversível.
		        {{ $v->id }}
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
		        <button type="button" onclick="excluir({{ $v->id }})" class="btn btn-danger">Excluir</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Fim modal de confirmação de exclusão -->

		<!-- Modal adiciona crédito -->
		<div class="modal fade" id="adicionacredito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Adicionar crédito</h5>
		        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form id="form" action="{{ route('adicionarcreditocliente', ['id' => $v->id]) }}" method="POST">
		      		@csrf
		      		{{ $v->id }}
		      		<input class="modalTextInput form-control" name="saldo" id="saldo" type="text" placeholder="1,99" />

		      		<div class="modal-footer">
		            	<button type="submit" class="btn btn-warning">Salvar</button>
		            </div>
		         </form>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Fim Modal adiciona crédito -->

		<!-- Scripts -->
		<script type="text/javascript">
   		$("#saldo").mask('#.##0,00', {
		     reverse: true,
		     translation: {
		        '#': {
		            pattern: /-|\d/,
		            recursive: true
		        }
		     },
		});
    	</script>
    
		<script>
			function excluir(id){
				location.href = route('excluicliente', {id : id});
			}

			function adicionaCreditoClienteId(id){
				identificador = id;
				return identificador;
			}
		</script>
		<!-- Fim Scripts -->
	@endsection