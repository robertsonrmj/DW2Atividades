<?php

use Illuminate\Support\Facades\Route;
use App\Cliente;
use App\Endereco;
use App\Curso;
use App\Disciplina;
use App\Aluno;
use App\Matricula;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main.index');
});

















Route::post('curso/add', function (Request $request) {

    $curso = new Curso();
    $curso->nome = $request->nome;
    $curso->tempo = $request->tempo;
    $curso->save();
    return "<h1>Curso Cadastrado com Sucesso!</h1>";
});

Route::post('disciplina/add', function (Request $request) {

    $c = Curso::find($request->curso_id);

    if(isset($c)) {
        $d = new Disciplina();
        $d->nome = $request->nome;
        $d->curso()->associate($c);
        $d->save();
        return "<h1>Disciplina Cadastrada com Sucesso!</h1>";
    }

    return "<h1>[ERRO] Curso NÃO ENCONTRADO!</h1>";
});

Route::get('curso', function () {

    $cursos = Curso::with(['disciplina'])->get();
    return $cursos->toJson();
});

Route::get('/disciplina', function () {

    $disciplinas = Disciplina::with(['curso'])->get();
    return $disciplinas->toJson();
});

Route::post('aluno/add', function (Request $request) {

    $aluno = new Aluno();
    $aluno->nome = $request->nome;
    $aluno->save();
    return "<h1>Aluno Cadastrado com Sucesso!</h1>";
});

Route::post('matricula/add', function (Request $request) {

    $aluno = Aluno::find($request->aluno_id);
    $disciplina = Disciplina::find($request->disciplina_id);

    if(isset($aluno) && isset($disciplina)) {
        $matricula = new Matricula();
        $matricula->aluno()->associate($aluno);
        $matricula->disciplina()->associate($disciplina);
        $matricula->save();

        return "<h1>Matrícula Efetuada com Sucesso!</h1>";
    }

    return "<h1>[ERRO] Aluno e/ou Disciplina NÃO ENCONTRADO(S)!</h1>";
});

Route::get('/aluno', function () {

    $alunos = Aluno::with(['disciplina'])->get();
    return $alunos->toJson();
});

Route::get('/aluno_pivot', function () {

    $alunos = Aluno::with(['disciplina'])->get();
    return $alunos->toJson();
});

Route::get('/disciplina_aluno', function () {

    $disciplinas = Disciplina::with(['aluno'])->get();
    return $disciplinas->toJson();
});

Route::get('/matricula', function () {

    $matriculas = Matricula::with(['aluno',
        'disciplina'])->get();
    return $matriculas->toJson();
});