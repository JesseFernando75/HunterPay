@extends('layouts.template')

	@section('scripts')
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
	@endsection
	
	@section('title') Transação @endsection

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

		<button href="#" data-toggle="modal" data-target="#adicionastatustransacao" class="btn btn-warning">Novo status de transação</button>

	  	<!-- Início formulário -->
		<div class="row">
		  	<div class="col-lg-4 col-md-5 col-sm-8 col-xs-8 mx-auto mt-5 text-light">
				<form class="row" action="{{ route('cadastratransacao', ['id' => $id_cliente]) }}" method="POST">
					@csrf
					<div class="col-md-6 mb-5">
					    <label class="form-label">Destino</label>
					    <select name="empresa" class="form-control" placeholder="Selecione a empresa:"required>
					    	@foreach($empresa as $e)
							  <option value="{{ $e->id }}">{{ $e->razao_social }}</option>
							@endforeach
						</select>
				  	</div>

					<div class="col-md-6 mb-5">
					    <label class="form-label">Valor</label>
					    <input type="text" class="form-control" name="valor" id="valor" placeholder="1,99" required />
					</div>

					<div class="col-md-12 d-grid gap-1 mb-5">
	                  	<button class="btn btn-light" type="submit">Transferir</button>
	                </div>

				</form>	
			</div>
		</div>
		<!-- Fim formulário -->

		<!-- Modal adiciona status -->
		<div class="modal fade" id="adicionastatustransacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Cadastrar novo status de transação</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form id="form" action="{{ route('cadastrarstatustransacao') }}" method="POST">
		      		@csrf
			      	<input class="modalTextInput form-control" name="nome" type="text" placeholder="Nome do status de transação" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" required/>

		      		<div class="modal-footer">
		            	<button type="submit" class="btn btn-warning">Salvar</button>
		            </div>
		         </form>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Fim Modal adiciona status -->


		<!-- Scripts -->
		<script type="text/javascript">
   			$("#valor").mask('#.##0,00', {
   				reverse: true,
				maxlength: false
   			});
    	</script>
    	<!-- Fim Scripts -->

	@endsection