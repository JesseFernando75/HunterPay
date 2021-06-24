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
					      			<a href="#" class="btn btn-danger btn-sm" data-id="{{ $v->id }}"onclick="$('#dataid').val($(this).data('id')); $('#exclusao').modal('show');">Excluir</a>
					      			<a href="{{ route('transacoescliente', ['id' => $v->id]) }}" class="btn btn-light btn-sm">Transações</a>
					      			<a href="{{ route('cadastrotransacaoauxiliar', ['id' => $v->id]) }}" class="btn btn-success btn-sm">Transferir</a>
					      		</td>
				      	    </tr>
				        @endforeach
				  </tbody>
				</table>
				<a href="{{ route('cadastrocliente') }}" class="btn mb-5 btn-light">Novo cliente</a>
			</div>
		</div>
		<!-- Fim tabela -->	

		<!-- Modal de confirmação -->
		<div class="modal fade" id="exclusao" tabindex="-1" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Excluir</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        Você realmente deseja excluir este cadastro? Essa ação é irreversível.
		      </div>
		      <div class="modal-footer">
		      	<form action="{{ route('excluicliente') }}" method="POST">
		      		@csrf
		      		<input type="hidden" class="form-control" name="id_cliente" id="dataid" value="" />
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button type="submit" class="btn btn-danger">Excluir</button>
			    </form>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Fim modal de confirmação -->

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
    		$('.delete').on('click', function(){
		      var id_cliente = $(this).data('id');
		      $('a.delete-yes').attr('href', 'excluicliente' +id);
		      $('#exclusao').modal('show');
		}	);    
		</script>

		<script>
			function excluir(id){
				location.href = route('excluicliente', {id : id});
			}
		</script>
		<!-- Fim Scripts -->
	@endsection