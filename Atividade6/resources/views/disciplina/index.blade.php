@extends('templates.main', ['titulo' => "Disciplinas", 'tag' => "DIC"])

@section('titulo') Disciplina @endsection

@section('conteudo')

<div class='row'>
    <div class='col-sm-12'>
        <button class="btn btn-primary btn-block" onClick="criar()">
            <b>Cadastrar Nova Disciplina</b>
        </button>
            
    </div>
    </div>
    <br>
<div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
    <table class='table table-striped' id="tabela">
        <thead>
            <tr style="text-align: center"> 
                
                <th>Nome</th>
                <th>Curso</th>
                <th>Professor</th>
                <th>Eventos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplinas as $item)
                <tr style="text-align: center">
                <td style="display:none;">{{ $item->id}}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->curso->nome }}</td>
                    <td>{{ $item->professor->nome }}</td>
                    <td>
                        <a nohref style="cursor:pointer" onClick="visualizar('{{$item->id}}')"><img src="{{ asset('img/icons/info.svg') }}"></a>
                        <a nohref style="cursor:pointer" onClick="editar('{{$item->id}}')"><img src="{{ asset('img/icons/edit.svg') }}"></a>
                        <a nohref style="cursor:pointer" onClick="remover('{{$item->id}}','{{$item->nome}}')"><img src="{{ asset('img/icons/delete.svg') }}"></a>
                        
                    </td>
                </tr>
                <form action="{{ route('disciplina.destroy', $item->id) }}"
                    method="POST" name="form_{{$item->id}}">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalDisciplina">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formDisciplina">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Nova Disciplina</b></h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="id">
                    <div class="row">
                        <div class="col-sm-12">
                            <label ><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-sm-12">
                            <label><b>Curso</b></label>
                            <select class="form-control" name="curso" id="curso" required>
                                @foreach ( $curso ?? [] as $item)
                                    <option value="{{ $item->id }}"><p> {{ $item->nome}} </p></option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row" style="margin-top:10px">
                        <div class="col-sm-12">
                            <label><b>Professor</b></label>
                            <select class="form-control" name="professor" id="professor" required>
                                @foreach ( $professor ?? [] as $item)
                                    <option value="{{ $item->id }}"><p> {{ $item->nome}} </p></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalInfo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Informações da Disciplina</b></h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalRemove">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="hidden" id="id_remove" class="form-control">
            <div class="modal-header">
                <h5 class="modal-title"><b>Remover Curso</b></h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" onClick="remove()"><b>Remover!</b></button>
                <button type="cancel" class="btn btn-secondary" data-dismiss="modal"><b>Cancelar!</b></button>
            </div>
        </div>
    </div>
</div>


@endsection



@section('script')

<script type="text/javascript">


    $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN' : "{{ csrf_token() }}"
        }
    });

    function criar(){
        $('#modalDisciplina').modal().find('.modal-title').text("Cadastrar Disciplina");
        $("#nome").val('');
        $("#curso").val('');
        $("#professor").val('');
        $('#modalDisciplina').modal('show');
    }

    function editar(id) {
        $('#modalDisciplina').modal().find('.modal-title').text("Alterar Professor");

        $.getJSON('/api/disciplina/'+id, function(data) {
            $('#id').val(data.id);
            $('#nome').val(data.nome);
            $('#curso').val(data.curso_id);
            $('#professor').val(data.professor_id);
            $('#modalDisciplina').modal('show');
        });
    }

    function remover(id,nome){
        $('#modalRemove').modal().find('.modal-body').html("");
        $('#modalRemove').modal().find('.modal-body').append("Deseja Remover a Disciplina '"+nome+"'?");
        $('#id_remove').val(id);
        $('#modalRemove').modal('show');
    }

    function visualizar(id){
        
        $("#modalInfo").modal().find('.modal-body').html("");

        $.getJSON('/api/disciplina/'+id, function(data){
            $("#modalInfo").modal().find('.modal-body').append("<b>ID: </b>"+ data.id+"<br></br>");
            $("#modalInfo").modal().find('.modal-body').append("<b>NOME: </b>"+ data.nome+"<br></br>");
            $("#modalInfo").modal().find('.modal-body').append("<b>CURSO: </b>"+ data.curso.nome+"<br></br>");
            $("#modalInfo").modal().find('.modal-body').append("<b>PROFESSOR: </b>"+ data.professor.nome+"<br></br>");
        })
    }

    $("#formDisciplina").submit( function(event){

        event.preventDefault();

        if ($("#id").val() != '') {
            update( $("#id").val() );
        }
        else {
            insert();
            
        }
        
        $("#modalDisciplina").modal('hide');
        
    });

    function insert() {
        disciplina = {
            nome: $("#nome").val(),
            curso: $("#curso").val(),
            professor: $("#professor").val(),
        };
        $.post("/api/disciplina", disciplina, function(data) {
            novaDisciplina = JSON.parse(data);
            linha = getLin(novaDisciplina);
            $("#tabela>tbody").append(linha);
            window.location.reload()
        });
        window.location.reload();
    }

    function update(id){
        
        disciplina = {
            nome: $("#nome").val(),
            curso: $("#curso").val(),
            professor: $("#professor").val(),
        };
        $.ajax({
            type: "PUT",
            url: "/api/disciplina/" + id,
            context: this,
            data: disciplina,
            success: function(data) {
                linhas = $("#tabela>tbody>tr");
                e = linhas.filter( function(i, e) {
                    return e.cells[0].textContent == id;
                });
                if (e) {
                    e[0].cells[1].textContent = disciplina.nome.toUpperCase();
                }
            },
            error: function(error) {
                alert('ERRO - UPDATE');
            }
        });
     
    }

    function remove() {

        var id = $('#id_remove').val();

        $.ajax({
            type: "DELETE",
            url: "/api/disciplina/" + id,
            context: this,
            success: function() {
                linhas = $("#tabela>tbody>tr");
                e = linhas.filter( function(i, elemento) {
                    return elemento.cells[0].textContent == id;
                });
                if (e) {
                    e.remove();
                }
            },
            error: function(error) {
                alert('ERRO - DELETE');
                
            }
        });

        $('#modalRemove').modal('hide');
    }

    function getLin(disciplina){

        var linha = 

        "<tr style='text-align: center'>" +
            "<td>"+disciplina.nome+"</td>" +
            "<td>"+disciplina.curso.nome+"</td>" +
            "<td>"+disciplina.professor.nome+"</td>" +
                    "<td>" +
                        "<a nohref style='cursor:pointer' onClick='visualizar("+disciplina.id+")'><img src={{ asset('img/icons/info.svg') }}></a>"+
                        "<a nohref style='cursor:pointer' onClick='editar("+disciplina.id+")'><img src={{ asset('img/icons/edit.svg') }}></a>"+
                        "<a nohref style='cursor:pointer' onClick='remover("+disciplina.id+")'><img src={{ asset('img/icons/delete.svg') }}></a>"+
                        
                    "</td>"+
        "</tr>"
        
        return linha;
    }

</script>

@endsection