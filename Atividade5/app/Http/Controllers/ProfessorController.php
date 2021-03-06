<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Professor;
use Symfony\Component\Console\Input\Input;

class ProfessorController extends Controller
{
   
    public function index(){
        $professores = Professor::all();
        return view('professor.index')->with('professores', $professores);

    }
    
   
    public function create(){ }

    
    public function store(Request $request){
        $professors = new Professor();
        $professors->nome = mb_strtoupper($request->input('nome'),'UTF-8');
        $professors->email = $request->input('email');
        $professors->save();

        return json_encode($professors);
    }


    public function show($id) {

        $professors = Professor::find($id);

        if (isset($professors)) {
            return json_encode($professors);
        }

        return response("Professor Não Encontrado", 404);
    }

   
    public function edit($id){ }


    public function update(Request $request, $id){
        
        $professors = Professor::find($id);


        if (isset($professors)) {
            $professors->nome = mb_strtoupper($request->input('nome'), 'UTF-8');
            $professors->email = $request->input('email');
            $professors->save();
            return json_encode($professors);
        }
        return response("Professor Não Encontrado", 404);
    
    }


    public function destroy($id){

        $professors = Professor::find($id);
        if (isset($professors)) {
            $professors->delete();
            return response('OK', 200);
        }
        return response('Professor não encontrada', 404);
    }

    public function loadJson() {

        $professors = Professor::all();
        return json_encode($professors);
    }
}