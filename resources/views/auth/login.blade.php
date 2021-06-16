@extends('layouts.template')

    @section('title') Login @endsection

    @section('estilo')

        .fundo{
            background-color: #fff;
            background-clip: padding-box;
            padding-top: 40px;
            padding-bottom: 40px;
            padding-left: 70px;
            padding-right: 70px;
            border-radius: 1.1rem;
        }

        a:link{
            text-decoration:none; 
        }

    @endsection

    @section('nav&footer')

    <!-- Início mensagem cadastro -->
        @if(session('Retorno'))
            <div class="row">
                <div class="alert alert-danger text-center py-3">
                    {{ session('Retorno') }}
                </div>
            </div>
        @endif
    <!-- Fim mensagem cadastro -->

    <!-- Início formulário -->
        <div class="row">
            <div class="row d-flex justify-content-md-center align-items-center vh-100">
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 text-dark fundo">

                    <span class="fs-1 text-center">Hunter<span style="color: #f9f871; font-weight: bold;">Pay</span></span>
                    <br>

                    <form action="{{ route('login') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                        <label class="form-label">E-mail</label>
                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                         @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="mb-4">
                        <label class="form-label">Senha ou token de acesso</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="d-grid gap-1 mb-4">
                        <button class="btn btn-dark" type="submit">Entrar</button>
                      </div>

                      <a href="{{ route('register') }}" class="text-muted">Não tem registro? Cadastre-se.</a>
                    </form> 
                </div>
            </div>
        </div>
    <!-- Fim formulário -->
    
    @endsection