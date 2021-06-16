<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fim Styles -->

	<!-- Scripts -->
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fim Scripts -->

	<!-- Início Template -->
	<style>
		@yield('estilo')
		html{
			height: 100%;
			min-height: 100%;
		}
		body{
			background-color: #333333;
			display: flex;
    		flex-direction: column;
    		min-height: 100%;
		}
		footer{
			margin-top: auto;
		}
	</style>
	<!-- Fim Template -->

	<!-- Início Template -->
	<title> @yield('title') </title>
	<!-- Fim Template --> 
</head>
<body>
	<!-- Inicio menu -->
	 <header>
		<nav class="navbar navbar-expand-md navbar-light shadow-sm py-3" style="background-color: #616161;">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <span class="font-weight-bold text-white" style="font-size: 18pt;">Hunter</span>
                    <span class="font-weight-bold" style="color: #f9f871; font-size: 18pt;">Pay</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                            @endif

                            @if (Route::has('register'))
                            @endif
                        @else
                            @if (Auth::user()->isAdmin())
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <a class="nav-link text-light" href="#">Clientes</a>
                                    <a class="nav-link text-light" href="#">Empresas Parceiras</a>
                                </ul>
                            </div>
                            @else
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        <a class="nav-link text-light" href="#">Transações</a>
                                    </ul>
                                </div>
                            @endif
                        @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-light mr-3 d-none d-md-block" href="{{ route('login') }}" role="button">Entrar</a>
                                    <a class="nav-link text-light d-sm-none" href="{{ route('login') }}">Entrar</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-light d-none d-md-block" href="{{ route('register') }}" role="button">Criar conta</a>
                                     <a class="nav-link text-light d-sm-none" href="{{ route('register') }}">Criar conta</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
  	<!-- Fim menu -->

  	<!-- Início Template -->
	@yield('nav&footer')
	<!-- Fim Template -->

  	<!-- Footer -->
	 <footer class="footer py-3" style="background-color: #616161;">
	    <div class="container text-center">
	      <span class="font-weight-bold text-white" style="font-size: 18pt;">Hunter</span>
          <span class="font-weight-bold" style="color: #f9f871; font-size: 18pt;">Pay</span><br>
          <span class="text-white">A sua plataforma de pagamentos online. - Copyright © 2021.</span><br><br>
	    </div>
  	 </footer>
  <!-- Fim footer -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>