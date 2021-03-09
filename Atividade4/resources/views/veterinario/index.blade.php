@extends('templates.main', ['titulo' => "Veterinarios", 'tag' => "VET"])

@section('titulo') Veterinarios @endsection

@section('conteudo')


    

    <div class='row'>
        <div class='col-sm-6'>
            <button class="btn btn-primary btn-block" onClick="criar()">
                <b>Cadastrar Novo Veterinario</b>
            </button>
                
        </div>
        <div class='col-sm-5' style="text-align: center">
            <input type="text" list="veterinario" class="form-control" autocomplete="on" placeholder="buscar">
            <datalist id="veterinario">
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
        <table class='table table-striped' id="tabela">
            <thead>
                <tr style="text-align: center"> 
                    
                    <th>Nome</th>
                   <th>Eventos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($veterinarios as $item)
                    <tr style="text-align: center">
                    <td style="display:none;">{{ $item->id}}</td>
                        <td>{{ $item->nome }}</td>
                        <td>
                            <a nohref style="cursor:pointer" onClick="visualizar('{{$item->id}}')"><img src="{{ asset('img/icons/info.svg') }}"></a>
                            <a nohref style="cursor:pointer" onClick="editar('{{$item->id}}')"><img src="{{ asset('img/icons/edit.svg') }}"></a>
                            <a nohref style="cursor:pointer" onClick="remover('{{$item->id}}','{{$item->nome}}')"><img src="{{ asset('img/icons/delete.svg') }}"></a>
                            
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

    <div class="modal fade" tabindex="-1" role="dialog" id="modalVeterinario">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formVeterinario">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Novo Veterinario</b></h5>
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
                                <label ><b>CRMV</b></label>
                                <input type="interger" class="form-control" name="crmv" id="crmv" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label><b>Especialidade</b></label>
                                <select class="form-control" name="especialidade" id="especialidade" required>
                                    @foreach ( $especialidade ?? [] as $item)
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
                    <h5 class="modal-title"><b>Informações do Veterinario</b></h5>
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
                    <h5 class="modal-title"><b>Remover Veterinario</b></h5>
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

        $especialidade = especialidade_id;

        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN' : "{{ csrf_token() }}"
            }
        });

        function criar(){
            $('#modalVeterinario').modal().find('.modal-title').text("Cadastrar Veterinario");
            $("#id").val('');
            $("#nome").val('');
            $("#crmv").val('');
            $("#especialidade").val('')
            $('#modalVeterinario').modal('show');
        }

        function editar(id) {
            $('#modalVeterinario').modal().find('.modal-title').text("Alterar Veterinario");

            $.getJSON('/api/veterinario/'+id, function(data) {
                
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#crmv').val(data.crmv);
                $('#especialidade').val(data.especialidade);
                $('#modalVeterinario').modal('show');
            });
        }

        function remover(id,nome){
            $('#modalRemove').modal().find('.modal-body').html("");
            $('#modalRemove').modal().find('.modal-body').append("Deseja Remover o Veterinario '"+nome+"'?");
            $('#id_remove').val(id);
            $('#modalRemove').modal('show');
        }

        function visualizar(id){
            
            $("#modalInfo").modal().find('.modal-body').html("");

            $.getJSON('/api/veterinario/'+id, function(data){
                $("#modalInfo").modal().find('.modal-body').append("<b>ID: </b>"+ data.id+"<br></br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>NOME: </b>"+ data.nome+"<br></br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>CRMV: </b>"+ data.crmv+"<br></br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>ESPECIALIDADE: </b>"+ data.especialidade.nome+"<br></br>");
                
            })
        }

        $("#formVeterinario").submit( function(event){

            event.preventDefault();

            if ($("#id").val() != '') {
                update( $("#id").val() );
            }
            else {
                insert();
                
            }

            $("#modalVeterinario").modal('hide');
        });

        function insert() {
            veterinario = {
                nome: $("#nome").val(),
                crmv: $("#crmv").val(),
                especialidade: $("#especialidade_id").val(),
                
            };
            $.post("/api/veterinario", veterinario, function(data) {
                novoVeterinario = JSON.parse(data);
                linha = getLin(novoVeterinario);
                $("#tabela>tbody").append(linha);
                window.location.reload();
            });

        }

        function update(id){
            
            veterinario = {
                nome: $("#nome").val(),
                crmv: $("#crmv").val(),
                especialidade: $("#especialidade").val(),
                
                
            }
            $.ajax({
                type: "PUT",
                url: "/api/veterinario/" + id,
                context: this,
                data: veterinario,
                success: function(data) {
                    linhas = $("#tabela>tbody>tr");
                    e = linhas.filter( function(i, e) {
                        return e.cells[0].textContent == id;
                    });
                    if (e) {
                        e[0].cells[1].textContent = veterinario.nome.toUpperCase();
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
                url: "/api/veterinario/" + id,
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

        function getLin(veterinario){

            var linha = 

            "<tr style='text-align: center'>" +
                "<td>"+veterinario.nome+"</td>" +
                        "<td>" +
                            "<a nohref style='cursor:pointer' onClick='visualizar("+veterinario.id+")'><img src={{ asset('img/icons/info.svg') }}></a>"+
                            "<a nohref style='cursor:pointer' onClick='editar("+veterinario.id+")'><img src={{ asset('img/icons/edit.svg') }}></a>"+
                            "<a nohref style='cursor:pointer' onClick='remover("+veterinario.id+")'><img src={{ asset('img/icons/delete.svg') }}></a>"+
                            
                        "</td>"+
            "</tr>"
            
            return linha;
        }

    </script>
    
@endsection
