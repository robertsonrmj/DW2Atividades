<hr size="1">
<h1>Sistema Gestão de Municípios - Governo Paraná</h1>

 
 <h4>[Cadastrar Nova Cidade] <a href="{{ route('cidade.index') }}"><input type="submit"value='Voltar' ></a></h4>
<hr size="1">

<form action="{{ route('cidade.store') }}" method="POST">
    @csrf
    
    <p>
    <label>Nome: </label> <input type='text' name='nome'>
    <p>
    <label for="porte">Porte:</label>
    <select name="porte" id="porte">
        <option value="Pequeno">Pequeno</option>
        <option value="Médio">Médio</option>
        <option value="Grande">Grande</option>
    </select>
    <hr>
    <input type="submit" value="Cadastrar">
</form>