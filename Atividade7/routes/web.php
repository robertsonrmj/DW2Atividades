<?php

use Illuminate\Support\Facades\Route;
use App\Cliente;
use App\Endereco;
use App\Curso;
use App\Disciplina;
use App\Aluno;
use App\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    return view('home');
})->name("home")->middleware('auth');

Route::get('restrito','RestritoController@index')->name('restrito');

Route::resource('aluno','AlunoController')->middleware('AccessLevel');;

Route::resource('curso','CursoController')->middleware('AccessLevel');;

Route::resource('disciplina','DisciplinaController')->middleware('AccessLevel');

Route::resource('professor','ProfessorController')->middleware('AccessLevel');


Auth::routes();









Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
