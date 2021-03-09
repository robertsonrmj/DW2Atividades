 
@extends('templates.default', ['titulo'=> "Restrito", 'tag' => "RES"])

@section('titulo') Restrito @endsection

@section('conteudo')


<div class="d-flex justify-content-center"> 
   
    <div>
        <h1 class="text-center "><b>Acesso Restrito</b></h1>
        <img src="{{ asset('img/restrito.png') }}">
    </div>
    
</div>

<div class='row'>
    <div class='col-sm-3'style="margin-top:20px">
        <a href="{{ route("home") }}" style = "text-decoration:none" >
            <button class="btn btn-dark btn-block ">
                <b>Voltar</b>
            </button>
        </a>
    </div>
</div>

@endsection
