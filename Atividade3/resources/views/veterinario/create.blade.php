@extends('templates.main', ['titulo' => "Cadastrar Veterinario", 'tag' => "VET"])

@section('titulo') Novo Veterinario @endsection

@section('conteudo')

    <form action="{{ route('veterinario.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class='row'>
                <div class='col-sm-6'>
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome">
                </div>
            </div>
            <div class="row">
                <div class='col-sm-6'>
                    <label>CRMV</label>
                    <input type="interger" class="form-control" name="crvm">
                </div>
                <div class='col-sm-6'>
                    <label>Especialidade</label>
                    <select class="form-control" name="especialidade">
                        @foreach( $especialidade as $item )
                            <option value="{{ $item['id'] }}"><p> {{ $item['nome']}} </p></option>
                        @endforeach
                    </select>
                </div>
    
            </div>
            <div class='row' style="margin-top:20px">
                <div class='col-sm-4'>
                        <a href="{{route('veterinario.index')}}" class="btn btn-danger btn-block"><b>Cancelar / Voltar</b></a>
                </div>
                <div class='col-sm-8'>
                    <button type="submit" class="btn btn-success btn-block"><b>Confirmar / Salvar</b></button>
                </div>
            </div>
        </div>
    </form>

@endsection