<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SISAR - Sistema de Avaliação Remota</title>
        <link rel="icon" href="{{ asset('img/ge_icon.ico') }}">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            body {
                padding: 60px;
                padding-top: 20px;
                padding-bottom: 20px;
            }
            footer {
                padding: 50px;
                padding-top: 30px;
            }
            .navbar { margin-bottom: 30px; }
            .nav-link { color: white; }

            .loading {
                position: fixed;
                z-index: 999;
                overflow: show;
                margin: auto;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                width: 50px;
                height: 50px;
            }
        </style>
    </head>

    <body role="document">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav">
                    @if($tag=='MENU') <img src="{{ asset('img/icons/home_ico.png') }} " width="50" height="50">
                        @elseif($tag=='CUR') <img src="{{ asset('img/icons/cursop_ico.png') }}" width="50" height="50">
                        @elseif($tag=='PROF') <img src="{{ asset('img/icons/professor_ico.png') }}" width="50" height="50">
                        @elseif($tag=='DIC') <img src="{{ asset('img/icons/disciplina_ico.png') }}" width="50" height="50">
                        @elseif($tag=='ALU') <img src="{{ asset('img/icons/aluno_ico.png') }}" width="50" height="50">
                        @elseif($tag=='MAT') <img src="{{ asset('img/icons/conceito_ico.png') }}" width="50" height="50">
                        @elseif($tag=='RES') <img src="{{ asset('img/restrito.png') }}" width="50" height="50">
                        @elseif($tag=='AUT') <img src="{{ asset('/img/login_ico.png') }}" width="50" height="50">
                        @elseif($tag=='REG') <img src="{{ asset('img/registro_ico.png') }}" width="50" height="50">
                        @elseif($tag=='EMA') <img src="{{ asset('img/reset_ico.png') }}" width="50" height="50">
                        @endif
                    &nbsp;&nbsp;&nbsp; <a class="navbar-brand mx-auto"><b>{{ $titulo }}</b></a>
                </ul>
            </div>
            <div class="mx-auto order-0">
                <a class="navbar-brand mx-auto"><b>SISAR - Sistema de Avaliação Remota</b></a>
            </div>

            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" style="color: #fff" href="{{ route('login') }}"><b>| {{ __('Login') }} |</b></a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" style="color: #fff" href="{{ route('register') }}"><b>| {{ __('Registro') }} |</b></a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: #fff" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <b>{{ Auth::user()->name }}</b><span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item">
                                    <u>Matrícula</u>: {{ Auth::user()->aluno_id }}
                                </a>
                                <a class="dropdown-item">
                                    <u>E-mail</u>: {{ Auth::user()->email }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <b>Sair</b>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <!-- <li class="active">
                        <a class="nav-link" href="{{ url('/') }}"><b>| Home |</b></a>
                    </li> -->
                </ul>
            </div>
        </nav>

        @yield('conteudo')

    </body>
    <hr>
    <footer>
        <b>&copy;2021
            &nbsp;&nbsp;&raquo;&nbsp;&nbsp;
           Robertson Mendes Junior
        </b>
    </footer>

    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>

    @yield('script')

</html>
