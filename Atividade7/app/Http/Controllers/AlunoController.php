<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Curso;
use \App\Aluno;
use Symfony\Component\Console\Input\Input;

class AlunoController extends Controller
{
   
    public function index(){
        $curso = Curso::all();
        $aluno = Aluno::all();

        return view('aluno.index', compact(['curso' , 'aluno']));

    }
    
   
    public function create(){ }

    
    public function store(Request $request){

        $c = Curso::find($request->curso);

        if(isset($c)) {
            $a = new Aluno();
            $a->nome = mb_strtoupper($request->input('nome'),'UTF-8');
            $a->email = $request->input('email');
            $a->curso()->associate($c);
            $a->save();
            return json_encode($a);
        }

        return response('Curso nao encontrado', 404);
    }


    public function show($id) {

        $aluno = Aluno::with('curso')->find($id);

        if (isset($aluno)) {
            return json_encode($aluno);
        }

        return response("Al Não Encontrado", 404);
    }

   
    public function edit($id){ }


    public function update(Request $request, $id){
        
        $a = Aluno::find($id);
        $c = Curso::find($request->curso);

        if(isset($a) && isset($c)) {
            $a->nome = mb_strtoupper($request->input('nome'),'UTF-8');
            $a->email = $request->input('email');
            $a->curso()->associate($c);
            $a->save();
            return json_encode($a);
        }

        return response('Aluno não encontrado', 404);
    }


    public function destroy($id){

        $aluno = Aluno::find($id);
        if (isset($aluno)) {
            $aluno->delete();
            return response('OK', 200);
        }
        return response('Disciplina não encontrada', 404);
    }

    public function loadJson() {

        $a = Aluno::all();
        return json_encode($a);
    }
}