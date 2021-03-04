@extends('templates.main', ['titulo' => "Veterinario", 'tag' => "VET"])

@section('titulo') Veterinarios @endsection

@section('conteudo')

    <div class='row'>
        <div class='col-sm-6'>
            <a  href="{{ route('veterinario.create') }}" type="button" class="btn btn-primary btn-block">
                <b>Cadastrar Novo Veterinário</b>
            </a>
        </div>
        <div class='col-sm-5' style="text-align: center">
            <input type="text" list="veterinarios" class="form-control" autocomplete="on" placeholder="buscar">
            <datalist id="veterinarios">
                @foreach ($veterinarios as $item)
                    <option value="{{ $item->nome }}">
                @endforeach
            </datalist>
        </div>
        <div class='col-sm-1' style="text-align: center">
            <button type="button" class="btn btn-default btn-block">
                <img src="{{ asset('img/icons/search.svg') }}">
            </button>
        </div>
    </div>
    <br>
    <div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
        <table class='table table-striped'>
            <thead>
                <tr style="text-align: center"> 
                    <th>Nome</th>
                   <th>Eventos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($veterinarios as $item)
                    <tr style="text-align: center">
                        <td>{{ $item->nome }}</td>
                        <td>
                            <a href="{{ route('veterinario.edit', $item->id) }}"><img src="{{ asset('img/icons/edit.svg') }}"></a>
                        </td>
                    </tr>
                    <form action="{{ route('veterinario.destroy', $item->id) }}"
                        method="POST" name="form_{{$item->id}}">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

