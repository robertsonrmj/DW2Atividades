

@extends('templates.main', ['titulo' => "Informações do Cliente", 'tag' => "CLI"])

@section('titulo') {{$cliente->nome}} @endsection

@section('conteudo')

    <ul class="list-group list-group-flush">
        <li class="list-group-item"><b>ID:</b> {{$cliente->id}}</li>
        <li class="list-group-item"><b>Nome:</b> {{$cliente->nome}}</li>
        <li class="list-group-item"><b>Telefone:</b> {{$cliente->telefone}}</li>
        <li class="list-group-item"><b>E-mail:</b> {{$cliente->email}}</li>
        <li class="list-group-item">
            <a href="{{route('cliente.index')}}" class="btn btn-secondary btn-block"><b>Voltar</b></a>
        </li>
    </ul>
@endsection
