

@extends('templates.main', ['titulo' => "Alterar Cliente", 'tag' => "CLI"])

@section('titulo') {{$cliente->nome}} @endsection

@section('conteudo')

    <form action="{{ route('cliente.update', $cliente['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class='row'>
                <div class='col-sm-6'>
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" value="{{$cliente->nome}}">
                </div>
                <div class='col-sm-6'>
                    <label>Telefone</label>
                    <input type="telefone" class="form-control" name="telefone" value="{{$cliente->telefone}}">
                </div>
                <div class='col-sm-6'>
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="email" value="{{$cliente->email}}">
                </div>
            </div>
            <div class='row' style="margin-top:20px">
                <div class='col-sm-4'>
                    <a href="{{route('cliente.index')}}" class="btn btn-danger btn-block"><b>Cancelar / Voltar</b></a>
                </div>
                <div class='col-sm-8'>
                    <button type="submit" class="btn btn-success btn-block"><b>Confirmar / Salvar</b></button>
                </div>
            </div>
        </div>
    </form>

@endsection
