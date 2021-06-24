@extends('layouts.template')

	@section('scripts')
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
	@endsection

	@section('title') Editar cliente @endsection

	@section('nav&footer')

		@if(Auth::user()->isAdmin())
		<button href="#" data-toggle="modal" data-target="#adicionacredito" class="btn btn-warning">Adicionar crédito</button>
		@endif

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

	  	<!-- Início formulário -->
	  	<div class="row">
		  	<div class="col-lg-4 col-md-5 col-sm-8 col-xs-8 mx-auto mt-4 text-light">
				<form class="row g-3" action="{{ route('editarcliente', ['id' => $v->id]) }}" method="POST">
					@csrf
					<div class="col-md-12 mb-3">
					    <label class="form-label">Nome</label>
					    <input type="text" name="nome" class="form-control" placeholder="Seu nome" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" value="{{ $v->nome }}" required>
					</div>

					<div class="col-md-6 mb-3">
					    <label class="form-label">CPF</label>
					    <input type="text" name="cpf" id="cpf" class="form-control" placeholder="000.000.000-00" value="{{ $v->cpf }}" required>
					</div>

					<div class="col-md-6 mb-3">
					    <label class="form-label">Telefone</label>
					    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(49) 3555-5555" value="{{ $v->telefone }}" required>
					</div>

					<div class="col-md-12 mb-4">
					    <label class="form-label">Número da conta</label>
					    <input type="number" name="num_conta" class="form-control" placeholder="67807" value="{{ $v->num_conta }}" required>
					</div>

					<div class="col-md-12 d-grid gap-1 mb-5">
	                  	<button class="btn btn-light" type="submit">Editar</button>
	                </div>

				</form>	
			</div>
		</div>
		<!-- Fim formulário -->

		<!-- Modal adiciona crédito -->
		<div class="modal fade" id="adicionacredito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Adicionar crédito</h5>  
				<button type="button" class="close" data-dismiss="modal" aria- label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
		      </div>
		      <div class="modal-body">
		      	<form id="form" action="{{ route('adicionarcreditocliente', ['id' => $v->id]) }}" method="POST">
		      		@csrf
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

		<script type="text/javascript">
   			$("#cpf").mask("000.000.000-00");
   			$("#telefone").mask("(00) 0000-0000");
    	</script>
    	<!-- Fim Scripts -->
		
	@endsection