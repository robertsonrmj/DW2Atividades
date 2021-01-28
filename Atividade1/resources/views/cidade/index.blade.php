<head>
<title>SGM- Governo Paraná</title>
<meta charset="utf-8" />
    <link href="Sistemas.css" rel="stylesheet" media="all" />
</head>




<hr size="1">
<h1>Sistema Gestão de Municípios - Governo do Paraná</h1>
<h4>[Menu Principal]</h4>
<hr size="1">
<a href="{{ route('cidade.create') }}"><input type="submit"value='Cadastrar Cidade' ></a>
<hr size="1">

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>CIDADE</th>
            <th>PORTE</th>
            <th>EDITAR</th>
            <th>REMOVER</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cidades as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['nome'] }}</td>
                <td>{{ $item['porte'] }}</td>
                
                <td>
                
                    <a href="{{ route('cidade.edit', $item['id']) }}"><input type="submit"value='Editar' ></a> 
                    
                </td>
                
                    <form action="{{ route('cidade.destroy', $item['id']) }}" method="POST">
                    <td>    
                    @csrf
                        @method('DELETE')
                        <input type='submit' value='remover'>
                        </td>
                    </form>
                
            
            </tr>
        @endforeach
    </tbody>
</table>