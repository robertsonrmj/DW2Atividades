@extends('templates.main', ['titulo' => "Cursos", 'tag' => "CUR"])

@section('titulo') Curso @endsection

@section('conteudo')

<div class='row'>
    <div class='col-sm-12'>
        <button class="btn btn-primary btn-block" onClick="criar()">
            <b>Cadastrar Novo Curso</b>
        </button>
            
    </div>
    </div>
    <br>
<div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
    <table class='table table-striped' id="tabela">
        <thead>
            <tr style="text-align: center"> 
                
                <th>Nome</th>
               <th>Eventos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $item)
                <tr style="text-align: center">
                <td style="display:none;">{{ $item->id}}</td>
                    <td>{{ $item->nome }}</td>
                    <td>
                        <a nohref style="cursor:pointer" onClick="visualizar('{{$item->id}}')"><img src="{{ asset('img/icons/info.svg') }}"></a>
                        <a nohref style="cursor:pointer" onClick="editar('{{$item->id}}')"><img src="{{ asset('img/icons/edit.svg') }}"></a>
                        <a nohref style="cursor:pointer" onClick="remover('{{$item->id}}','{{$item->nome}}')"><img src="{{ asset('img/icons/delete.svg') }}"></a>
                        
                    </td>
                </tr>
                <form action="{{ route('curso.destroy', $item->id) }}"
                    method="POST" name="form_{{$item->id}}">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalCurso">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formCurso">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Novo Curso</b></h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="id">
                    <div class="row">
                        <div class="col-sm-12">
                            <label ><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
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
                <h5 class="modal-title"><b>Informações do Curso</b></h5>
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
        $('#modalCurso').modal().find('.modal-title').text("Cadastrar Curso"); 
        $("#nome").val('');
        $('#modalCurso').modal('show');
    }

    function editar(id) {
        $('#modalCurso').modal().find('.modal-title').text("Alterar Curso");

        $.getJSON('/api/curso/'+id, function(data) {
            $('#id').val(data.id);
            $('#nome').val(data.nome);
            $('#modalCurso').modal('show');
        });
    }

    function remover(id,nome){
        $('#modalRemove').modal().find('.modal-body').html("");
        $('#modalRemove').modal().find('.modal-body').append("Deseja Remover o Curso '"+nome+"'?");
        $('#id_remove').val(id);
        $('#modalRemove').modal('show');
    }

    function visualizar(id){
        
        $("#modalInfo").modal().find('.modal-body').html("");

        $.getJSON('/api/curso/'+id, function(data){
            $("#modalInfo").modal().find('.modal-body').append("<b>ID: </b>"+ data.id+"<br></br>");
            $("#modalInfo").modal().find('.modal-body').append("<b>NOME: </b>"+ data.nome+"<br></br>");
        })
    }

    $("#formCurso").submit( function(event){

        event.preventDefault();

        if ($("#id").val() != '') {
            update( $("#id").val() );
        }
        else {
            insert();
            
        }
        
        $("#modalCurso").modal('hide');
        
    });

    function insert() {
        curso = {
            nome: $("#nome").val(),
        };
        $.post("/api/curso", curso, function(data) {
            novoCurso = JSON.parse(data);
            linha = getLin(novoCurso);
            $("#tabela>tbody").append(linha);
            
        });
        
    }

    function update(id){
        
        curso= {
            nome: $("#nome").val(), 
        };
        $.ajax({
            type: "PUT",
            url: "/api/curso/" + id,
            context: this,
            data: curso,
            success: function(data) {
                linhas = $("#tabela>tbody>tr");
                e = linhas.filter( function(i, e) {
                    return e.cells[0].textContent == id;
                });
                if (e) {
                    e[0].cells[1].textContent = curso.nome.toUpperCase();
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
            url: "/api/curso/" + id,
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

    function getLin(curso){

        var linha = 

        "<tr style='text-align: center'>" +
            "<td>"+curso.nome+"</td>" +
                    "<td>" +
                        "<a nohref style='cursor:pointer' onClick='visualizar("+curso.id+")'><img src={{ asset('img/icons/info.svg') }}></a>"+
                        "<a nohref style='cursor:pointer' onClick='editar("+curso.id+")'><img src={{ asset('img/icons/edit.svg') }}></a>"+
                        "<a nohref style='cursor:pointer' onClick='remover("+curso.id+")'><img src={{ asset('img/icons/delete.svg') }}></a>"+
                        
                    "</td>"+
        "</tr>"
        
        return linha;
    }

</script>

@endsection