<html>
    <head>
        <title>VetClin - @yield('titulo')</title>
        <meta charset="UTF-8">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body { padding: 40px; }
            .navbar { margin-bottom: 30px; }
            .card{ margin: 20px; }
            .card-header { color: white; }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-success">
            <a class="navbar-brand" href="#"><b>VetClin System</b></a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li @if($tag=="CLI") class="nav-item active" @else class="nav-item" @endif>
                        <a class="nav-link" href="{{ route('cliente.index') }}">
                            
                            <b>Clientes</b>
                        </a>
                    </li>
                    <li @if($tag=="VET") class="nav-item active" @else class="nav-item" @endif>
                        <a class="nav-link" href="{{ route('veterinario.index') }}">
                            <b>Veterinários</b>
                        </a>
                    </li>
                    <li @if($tag=="ESP") class="nav-item active" @else class="nav-item" @endif>
                        <a class="nav-link" href="{{ route('especialidade.index') }}">
                            <b>Especialidades</b>
                        </a>
                    </li>
                    <li @if($tag=="PET") class="nav-item active" @else class="nav-item" @endif>
                        <a class="nav-link" href="#">
                            <b>Pets</b>
                        </a>
                    </li>
                    <li @if($tag=="RAC") class="nav-item active" @else class="nav-item" @endif>
                        <a class="nav-link" href="#">
                            <b>Raças</b>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="card">
            <div class="card-header bg-success align-itens">
                <h3>
                    <b>{{$titulo}}</b>
                    @if ($tag=="CLI")
                    <img  src="{{ asset('img/icons/face.svg') }}"Align = "right" width="40px">
                    @endif
                    @if ($tag=="ESP")
                    <img  src="{{ asset('img/icons/games.svg') }}"Align = "right" width="40px">
                    @endif
                    @if ($tag=="VET")
                    <img  src="{{ asset('img/icons/veter.svg') }}"Align = "right" width="40px">
                    @endif
                </h3>
                
            </div>
            <div class="card-body">
                @yield('conteudo')
            </div>
        </div>
        <hr>
    </body>
    <footer>
        <b>&copy;2021 Robertson Mendes Junior.</b>
    </footer>
    <script scr='{{asset('js/app.js')}}' type='text/javascript'></script>
</html>