@extends('templates.main', ['titulo' => "Cadastrar Especialidade", 'tag' => "ESP"])

@section('titulo') Nova Especialidade @endsection

@section('conteudo')

    <form action="{{ route('especialidade.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class='row'>
                <div class='col-sm-6'>
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome">
                </div>
                <div class='col-sm-6'>
                    <label>descricao</label>
                    <input type="text" class="form-control" name="descricao">
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