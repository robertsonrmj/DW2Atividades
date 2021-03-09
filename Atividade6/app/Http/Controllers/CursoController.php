<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Curso;

use Symfony\Component\Console\Input\Input;

class CursoController extends Controller
{
   
    public function index(){
        $cursos = Curso::all();
        return view('curso.index')->with('cursos', $cursos);

    }
    
   
    public function create(){ }

    
    public function store(Request $request){
        $curso = new Curso();
        $curso->nome = mb_strtoupper($request->input('nome'),'UTF-8');
        $curso->save();

        return json_encode($curso);
    }


    public function show($id) {

        $curso = Curso::find($id);

        if (isset($curso)) {
            return json_encode($curso);
        }

        return response("Curso Não Encontrado", 404);
    }

   
    public function edit($id){ }


    public function update(Request $request, $id){
        
        $curso = Curso::find($id);


        if (isset($curso)) {
            $curso->nome = mb_strtoupper($request->input('nome'), 'UTF-8');
            $curso->save();
            return json_encode($curso);
        }
        return response("Curso Não Encontrado", 404);
    
    }


    public function destroy($id){

        $curso = Curso::find($id);
        if (isset($curso)) {
            $curso->delete();
            return response('OK', 200);
        }
        return response('Cursonão encontrada', 404);
    }

    public function loadJson() {

        $curso = Curso::all();
        return json_encode($curso);
    }
}