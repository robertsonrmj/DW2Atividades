<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Veterinario;
use App\Especialidade;

class VeterinarioController extends Controller{
   
    public function index(){
        $especialidade = Especialidade::all();
        $veterinarios = Veterinario::all();

        return view('veterinario.index', compact(['veterinarios' , 'especialidade']));
    }
    
    public function create(){ }

    public function store(Request $request){
        $veterinario = new Veterinario();
        $veterinario->nome = mb_strtoupper($request->input('nome'),'UTF-8');
        $veterinario->crmv = $request -> input('crmv');
        $veterinario->especialidade = $request -> input('especialidade');
        $veterinario-> save();

        return json_encode($veterinario);
    }

    public function show($id){
        $veterinario = Veterinario::with('especialidade')->find($id);

        if(isset($veterinario)){
            return json_encode($veterinario);
        }

        return response('Veterinario não encontrado', 404);
    }

    public function edit($id){ }

    public function update(Request $request, $id){
        $veterinario = Veterinario::find($id);

        if(isset($veterinario)){
            $veterinario->nome = mb_strtoupper($request->input('nome'),'UTF-8');
            $veterinario->crmv = $request -> input('crmv');
            $veterinario->especialidade = $request -> input('especialidade');
            $veterinario->save();
            
            return json_encode($veterinario);
        }
        return response("Veterinario não encontrado!", 404);
    }

    public function destroy($id){
        $veterinario = veterinario::find($id);

        if(isset($veterinario)){
            $veterinario -> delete();
            return response("OK", 200);
        }
        return response('Cliente não encontrado', 404);
    }
}