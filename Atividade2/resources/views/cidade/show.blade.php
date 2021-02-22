@extends('templates.main')

@section('titulo') Detalhes @endsection

@section('conteudo')
<div class="card">
    <div class="card-body">
        <h4>Cidade: {{ $dados['nome'] }}</h4>
        <h4>Porte: {{ $dados['porte'] }}</h4>
        <hr>
        <a href="{{route('cidade.index')}}" type="button" class="btn btn-primary btn-block">voltar</a>
    </div>
</div>


@endsection