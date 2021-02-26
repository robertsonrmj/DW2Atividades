<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Veterinario;
use \App\Especialidade;

class VeterinarioController extends Controller
{
    
    public function index()
    {
        $veterinarios = Veterinario::all();
        return view('veterinario.index', compact(['veterinarios']));
    }

    public function create()
    {
        $especialidade = Especialidade::all();

        return view('veterinario.create', compact('especialidade'));
    }

    public function store(Request $request){
        
        $veterinario = new Veterinario();
        $veterinario->nome = mb_strtoupper($request->input('nome'),'UTF-8');
        $veterinario->crmv  = $request->input('crvm');
        $veterinario->especialidade_id = $request->especialidade;
        $veterinario->save();

        return redirect()->route('veterinario.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)

    {   
        $especialidades = Especialidade::all();
        $veterinario = Veterinario::find($id);
        $especialidade = Especialidade::all();

        
            return view('veterinario.edit', compact(['veterinario','especialidades','especialidade']));
    }
    

   
    public function update(Request $request, $id){
        $especialidades = Especialidade::all();
        
        if (isset($veterinario)) {
        $veterinario = new Veterinario();
        $veterinario->nome = mb_strtoupper($request->input('nome'),'UTF-8');
        $veterinario->crmv = $request->crmv;
        $veterinario->especialidade_id = $request->especialidade;
        $veterinario->save();
        }
        return redirect()->route('veterinario.index');
    }

    public function destroy($id)
    {
        //
    }
}
