<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Disciplina;
use \App\Curso;
use \App\Professor;
use Symfony\Component\Console\Input\Input;

class DisciplinaController extends Controller
{
   
    public function index(){
        $curso = Curso::all();
        $professor = Professor::all();
        $disciplinas = Disciplina::with(['professor','curso'])->get();
        $professor = Professor::all();
        return view('disciplina.index', compact(['disciplinas' , 'curso','professor']));

    }
    
   
    public function create(){ }

    
    public function store(Request $request){

        $c = Curso::find($request->curso);
        $p = Professor::find($request->professor);

        if(isset($c) && isset ($p)) {
            $d = new Disciplina();
            $d->nome = mb_strtoupper($request->input('nome'),'UTF-8');
            $d->curso()->associate($c);
            $d->professor()->associate($p);
            $d->save();
            return json_encode($d);
        }

        return response('Curso ou disciplina nao encontrado', 404);
    }


    public function show($id) {

        $disciplina = Disciplina::with('curso', 'professor')->find($id);

        if (isset($disciplina)) {
            return json_encode($disciplina);
        }

        return response("Disciplina Não Encontrado", 404);
    }

   
    public function edit($id){ }


    public function update(Request $request, $id){
        
        $d= Disciplina::find($id);

        $c = Curso::find($request->curso);
        $p = Professor::find($request->professor);

        if(isset($c) && isset ($d) && isset($p)){
            $d->nome = mb_strtoupper($request->input('nome'),'UTF-8');
            $d->curso()->associate($c);
            $d->professor()->associate($p);
            $d->save();
            return json_encode($d);
        }
        
        return response("Disciplina Não Encontrado", 404);
    
    }


    public function destroy($id){

        $disciplina = Disciplina::find($id);
        if (isset($disciplina)) {
            $disciplina->delete();
            return response('OK', 200);
        }
        return response('Disciplina não encontrada', 404);
    }

    public function loadJson() {

        $disciplina = Disciplina::all();
        return json_encode($disciplina);
    }
}