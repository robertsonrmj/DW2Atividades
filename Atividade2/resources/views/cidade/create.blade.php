@extends('templates.main',['titulo'=>"Nova Cidade"])

@section('titulo') Nova Cidade @endsection

@section('conteudo')

<form action="{{ route('cidade.store') }}" method="POST">
    @csrf
    <div class="row">
        <button type="submit" class="btn btn-primary  col-sm-10">
            Confirmar/Cadastrar
        </button>
        <hr>
        <div class="btn btn-warning col-sm-2">
            <a href="{{route('cidade.index')}}" type="button" class="">voltar</a>
        </div>
        </div>
    <hr>
    <form>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-9">
                    <label for="cidadeInput">Cidade: </label>
                    <input name='nome' type="text" class="form-control" id="cidadeInput" placeholder="Cidade">

                </div>
                <div class="col-lg-3">
                    <label for="inputPorte">Porte</label>
                    <select name='porte' id="inputPorte" class="form-control">
                        <option>Pequena</option>
                        <option>Média</option>
                        <option>Grande</option>
                    </select>
                </div>
            </div>
        </div>

    </form>
    @endsection