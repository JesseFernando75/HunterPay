@extends('layouts.template')

	@section('scripts')
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
	@endsection
	
	@section('title') Cadastro de cliente @endsection

	@section('nav&footer')
	  	<!-- Início formulário -->
		<div class="row">
		  	<div class="col-lg-4 col-md-5 col-sm-8 col-xs-8 mx-auto mt-5 text-light">
				<form class="row g-3" action="{{ route('cadastrarcliente', ['id' => $id_user]) }}" method="POST">
					@csrf
					<div class="col-md-12 mb-3">
					    <label class="form-label">Informe o seu nome</label>
					    <input type="text" name="nome" class="form-control" placeholder="Seu nome" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" required>
					</div>

					<div class="col-md-6 mb-3">
					    <label class="form-label">Informe o seu CPF</label>
					    <input type="text" name="cpf" id="cpf" class="form-control" placeholder="000.000.000-00" required>
					</div>

					<div class="col-md-6 mb-4">
					    <label class="form-label">Informe o seu telefone</label>
					    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(49) 3555-5555" required>
					</div>

					<div class="col-md-12 d-grid gap-1 mb-5">
	                  	<button class="btn btn-light" type="submit">Salvar</button>
	                </div>

				</form>	
			</div>
		</div>
		<!-- Fim formulário -->

		<!-- Scripts -->
		<script type="text/javascript">
   			$("#cpf").mask("000.000.000-00");
   			$("#telefone").mask("(00) 0000-0000");
    	</script>
    	<!-- Fim Scripts -->

	@endsection
        