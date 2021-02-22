<html>
    <head>
        <title>SGM - @yield('titulo')</title>
        <meta charset="UTF-8">
        <link href="{{ asset('css/app.css')}}" rel="stylesheet">
        <style>
            body { padding: 40px; margin: 20px; }
            .navbar { margin-bottom: 30px;}
            /*.card{ margin: 20px; }*/
            .navbar-brand {
                margin-left: auto;
                margin-right: auto;
            }
            .card-header { color: black; }
            .navbar h4{ color: #ffffff}
        
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">

            <img src="{{ asset('img/icons/reorder.svg') }}"> <b>{{$titulo ?? ''}}</b>
                <b>Cidades</b>
            </a>
            
           
            <a class="navbar-brand" href="#"><b>Sistema de Gestão de Municipios</b></a>
            
        </nav>
            
            
                @yield('conteudo')
            
        
        <hr>
    </body>
    <footer>
        <b>&copy;2020 - Robertson Mendes Junior.</b>
    </footer>
<script src='{{asset ('js/app./js')}}' type='text.javascript'></script>
</html>