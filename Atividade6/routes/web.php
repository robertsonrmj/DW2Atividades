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
    return view('home.index');
})->name("home")->middleware('AccessLevel');

Route::get('restrito','RestritoController@index')->name('restrito');

Route::resource('aluno','AlunoController');

Route::resource('curso','CursoController');

Route::resource('disciplina','DisciplinaController');

Route::resource('professor','ProfessorController');











