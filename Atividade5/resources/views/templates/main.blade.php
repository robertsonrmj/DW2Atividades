<html>
    <head>
        <title>SISAR - @yield('titulo')</title>
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
        
        <div class="card">
            <div class="card-header bg-dark">
                <div class="row">
                    <div class="col-sm-0">
                        @if($tag=='HOME') <img src="{{ asset('img/icons/home_ico.png') }} " width="50" height="50">
                        @elseif($tag=='CUR') <img src="{{ asset('img/icons/cursop_ico.png') }}" width="50" height="50">
                        @elseif($tag=='PROF') <img src="{{ asset('img/icons/professor_ico.png') }}" width="50" height="50">
                        @elseif($tag=='DIC') <img src="{{ asset('img/icons/disciplina_ico.png') }}" width="50" height="50">
                        @elseif($tag=='ALU') <img src="{{ asset('img/icons/aluno_ico.png') }}" width="50" height="50">
                        @elseif($tag=='MAT') <img src="{{ asset('img/icons/conceito_ico.png') }}" width="50" height="50">
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <h2><b>{{$titulo}}</b></h2>
                    </div>
                    <div class="col-sm-8">
                        <h2> SISAR - Sistema de Avaliação Remota</h2>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
            <div class="card-body">
                @yield('conteudo')
            </div>
        </div>
        <hr>
    </body>
    <footer>
        <b>&copy;2021 - Robertson Mendes Junior.</b>
    </footer>

    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>

    @yield('script')

</html>