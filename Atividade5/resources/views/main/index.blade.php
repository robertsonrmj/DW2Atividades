@extends('templates.main', ['titulo' => "Menu", 'tag' => "HOME"])

@section('titulo') Menu @endsection

@section('conteudo')

    <div class="d-flex justify-content-center">
        <div>
        <a href="{{ route('curso.index') }}" style = "text-decoration:none" >
                <img src="{{asset('img/curso_ico.png')}}" width="200" height="200" hspace="20" class="img-thumbnail" alt="...">
                <div class="card-body">
                    <p class="card-text h1  text-center">Curso</p>
                </div>
            </a>
        </div>
        <div>
            <a href="{{ route('disciplina.index') }}" style = "text-decoration:none">
                <img src="{{asset('img/disciplina_ico.png')}}"  width="200" height="200" hspace="20" class="img-thumbnail" alt="...">
                <div class="card-body">
                    <p class="card-text h1 text-center">Disciplina</p>
                </div>
            </a>
        </div>
        <div>
            <a href="{{ route('professor.index') }}" style = "text-decoration:none">
                <img src="{{asset('img/professor_ico.png')}}"  width="200" height="200" hspace="20" class="img-thumbnail" alt="..." >
                <div class="card-body">
                    <p class="card-text h1 text-center">Professor</p>
                </div>
            </a>
        </div>
        <div>
            <a href="{{ route('aluno.index') }}" style = "text-decoration:none">
                <img src="{{asset('img/aluno_ico.png')}}"  width="200" height="200" hspace="20" class="img-thumbnail" alt="...">
                <div class="card-body">
                    <p class="card-text h1 text-center">Aluno</p>
                </div>
            </a>
        </div>
    </div>
@endsection