@extends('templates.default', ['titulo' => "Professores", 'tag' => "PROF"])

@section('titulo') Professor @endsection

@section('conteudo')

<div class='row'>
    <div class='col-sm-12'>
        <button class="btn btn-primary btn-block" onClick="criar()">
            <b>Cadastrar Novo Professor</b>
        </button>
            
    </div>
    </div>
    <br>
<div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
    <table class='table table-striped' id="tabela">
        <thead>
            <tr style="text-align: center"> 
                
                <th>Nome</th>
                <th>E-mail</th>
               <th>Eventos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professores as $item)
                <tr style="text-align: center">
                <td style="display:none;">{{ $item->id}}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <a nohref style="cursor:pointer" onClick="visualizar('{{$item->id}}')"><img src="{{ asset('img/icons/info.svg') }}"></a>
                        <a nohref style="cursor:pointer" onClick="editar('{{$item->id}}')"><img src="{{ asset('img/icons/edit.svg') }}"></a>
                        <a nohref style="cursor:pointer" onClick="remover('{{$item->id}}','{{$item->nome}}')"><img src="{{ asset('img/icons/delete.svg') }}"></a>
                        
                    </td>
                </tr>
                <form action="{{ route('professor.destroy', $item->id) }}"
                    method="POST" name="form_{{$item->id}}">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalProfessor">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formProfessor">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Novo Professor</b></h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="id">
                    <div class="row">
                        <div class="col-sm-12">
                            <label ><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label ><b>E-mail</b></label>
                            <input type="email" class="form-control" name="email" id="email" required>
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
                <h5 class="modal-title"><b>Informações do Professor</b></h5>
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
                <h5 class="modal-title"><b>Remover Professor</b></h5>
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
        $('#modalProfessor').modal().find('.modal-title').text("Cadastrar Professor"); 
        $("#nome").val('');
        $("#email").val('');
        $('#modalProfessor').modal('show');
    }

    function editar(id) {
        $('#modalProfessor').modal().find('.modal-title').text("Alterar Professor");

        $.getJSON('/api/professor/'+id, function(data) {
            $('#id').val(data.id);
            $('#nome').val(data.nome);
            $('#email').val(data.email);
            $('#modalProfessor').modal('show');
        });
    }

    function remover(id,nome){
        $('#modalRemove').modal().find('.modal-body').html("");
        $('#modalRemove').modal().find('.modal-body').append("Deseja Remover o Professor '"+nome+"'?");
        $('#id_remove').val(id);
        $('#modalRemove').modal('show');
    }

    function visualizar(id){
        
        $("#modalInfo").modal().find('.modal-body').html("");

        $.getJSON('/api/professor/'+id, function(data){
            $("#modalInfo").modal().find('.modal-body').append("<b>ID: </b>"+ data.id+"<br></br>");
            $("#modalInfo").modal().find('.modal-body').append("<b>NOME: </b>"+ data.nome+"<br></br>");
            $("#modalInfo").modal().find('.modal-body').append("<b>E-mail: </b>"+ data.email+"<br></br>");
        })
    }

    $("#formProfessor").submit( function(event){

        event.preventDefault();

        if ($("#id").val() != '') {
            update( $("#id").val() );
        }
        else {
            insert();
            
        }
        
        $("#modalProfessor").modal('hide');
        
    });

    function insert() {
        professor = {
            nome: $("#nome").val(),
            email: $("#email").val(),
        };
        $.post("/api/professor", professor, function(data) {
            novoProfessor = JSON.parse(data);
            linha = getLin(novoProfessor);
            $("#tabela>tbody").append(linha);
            window.location.reload()
        });
        window.location.reload();
    }

    function update(id){
        
        professor= {
            nome: $("#nome").val(),
            email: $("#email").val(), 
        };
        $.ajax({
            type: "PUT",
            url: "/api/professor/" + id,
            context: this,
            data: professor,
            success: function(data) {
                linhas = $("#tabela>tbody>tr");
                e = linhas.filter( function(i, e) {
                    return e.cells[0].textContent == id;
                });
                if (e) {
                    e[0].cells[1].textContent = professor.nome.toUpperCase();
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
            url: "/api/professor/" + id,
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

    function getLin(professor){

        var linha = 

        "<tr style='text-align: center'>" +
            "<td>"+professor.nome+"</td>" +
                    "<td>" +
                        "<a nohref style='cursor:pointer' onClick='visualizar("+professor.id+")'><img src={{ asset('img/icons/info.svg') }}></a>"+
                        "<a nohref style='cursor:pointer' onClick='editar("+professor.id+")'><img src={{ asset('img/icons/edit.svg') }}></a>"+
                        "<a nohref style='cursor:pointer' onClick='remover"+professor.id+")'><img src={{ asset('img/icons/delete.svg') }}></a>"+
                        
                    "</td>"+
        "</tr>"
        
        return linha;
    }

</script>

@endsection