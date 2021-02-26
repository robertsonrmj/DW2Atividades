

@extends('templates.main', ['titulo' => "Alterar Especialidade", 'tag' => "ESP"])

@section('titulo') {{$especialidade->nome}} @endsection

@section('conteudo')

    <form action="{{ route('especialidade.update', $especialidade['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class='row'>
                <div class='col-sm-12'>
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" value="{{$especialidade->nome}}">
                </div>
               
            </div>
            <div class='row'>
                <div class='col-sm-12'>
                    <label>Descrição</label>
                    <input type="descricao" class="form-control" name="descricao" value="{{$especialidade->descricao}}">
                </div>
            </div>
            <div class='row' style="margin-top:20px">
                <div class='col-sm-4'>
                    <a href="{{route('especialidade.index')}}" class="btn btn-danger btn-block"><b>Cancelar / Voltar</b></a>
                </div>
                <div class='col-sm-8'>
                    <button type="submit" class="btn btn-success btn-block"><b>Confirmar / Salvar</b></button>
                </div>
            </div>
        </div>
    </form>

@endsection