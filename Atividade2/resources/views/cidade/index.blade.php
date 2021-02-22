@extends('/templates.main')

@section('conteudo')

<div class='row'>
    <div class='col-sm-12'>
        <a href="{{ route('cidade.create') }}" class="btn btn-primary btn-block">
            <b>Cadastrar Nova Cidade</b>
        </a>
    </div>
</div>
<br>

<x-tablelist :header="['CIDADE', 'EVENTO']" :data="$cidades"/>

@endsection
