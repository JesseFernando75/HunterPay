@extends('layouts.template')

    @section('title') Cadastre-se @endsection

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

    <!-- Início formulário -->
        <div class="row">
            <div class="row d-flex justify-content-md-center align-items-center vh-100">
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 text-dark fundo">

                    <span class="fs-4 text-center fw-bold">Como você gostaria de usar o Hunter <span style="color: #f9f871; font-weight: bold;">Pay</span>?</span>
                    <br>

                    <div class="d-grid gap-1 mb-4 mt-4">
                        <a class="btn btn-dark btn-lg" href="{{ route('cadastroclientelogin') }}" role="button">Para mim</a>
                      </div>

                      <div class="d-grid gap-1 mb-4">
                         <a class="btn btn-outline-dark btn-lg" href="{{ route('cadastroempresalogin') }}" role="button">Para minha empresa</a>
                      </div>

                </div>
            </div>
        </div>
    <!-- Fim formulário -->

    @endsection