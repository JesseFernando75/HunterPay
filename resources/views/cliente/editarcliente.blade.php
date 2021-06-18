@extends('layouts.template')

	@section('scripts')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
	@endsection

	@section('title') Editar cliente @endsection

	@section('nav&footer')
	  	<!-- Início formulário -->
	  	<div class="row">
		  	<div class="col-lg-4 col-md-5 col-sm-8 col-xs-8 mx-auto mt-5 text-light">
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

					<div class="col-md-6 mb-3">
						<label for="f_email">Email</label>
					   <input type="email" class="form-control" id="f_email" placeholder="name@example.com" name="email" value="{{ $v->email }}"required>
					</div>
					
					<div class="col-md-6 mb-3">
						<label for="f_senha">Senha</label>
					 <input type="password" class="form-control" id="f_senha" placeholder="Senha" name="senha" value="{{ $v->senha }}"required>
					</div>

					<div class="col-md-6 mb-3">
					  <label for="floatingInput">Cidade:</label>
					  <input type="text" class="form-control"  placeholder="Cidade"  name="cidade" id="cidade" value="{{ $v->cidade }}"required>
					</div>

					<div class="col-md-12 d-grid gap-1 mb-5">
	                  	<button class="btn btn-light" type="submit">Editar</button>
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