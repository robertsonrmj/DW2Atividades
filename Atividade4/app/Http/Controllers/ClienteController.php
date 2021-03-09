<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Cliente;
use Symfony\Component\Console\Input\Input;

class ClienteController extends Controller
{
   
    public function index(){
        $clientes = Cliente::all();
        return view('cliente.index')->with('clientes', $clientes);

    }
    
   
    public function create(){ }

    
    public function store(Request $request){
        $cliente = new Cliente();
        $cliente->nome = mb_strtoupper($request->input('nome'),'UTF-8');
        $cliente->telefone = $request->input('telefone');
        $cliente->email = $request->input('email');
        $cliente->save();

        return json_encode($cliente);
    }


    public function show($id) {

        $cliente = Cliente::find($id);

        if (isset($cliente)) {
            return json_encode($cliente);
        }

        return response("Cliente Não Encontrado", 404);
    }

   
    public function edit($id){ }


    public function update(Request $request, $id){
        
        $cliente = Cliente::find($id);


        if (isset($cliente)) {
            $cliente->nome = mb_strtoupper($request->input('nome'), 'UTF-8');
            $cliente->telefone = $request->input('telefone');
            $cliente->email = $request->input('email');
            $cliente->save();
            return json_encode($cliente);
        }
        return response("Cliente Não Encontrado", 404);
    
    }


    public function destroy($id){

        $cliente = Cliente::find($id);
        if (isset($cliente)) {
            $cliente->delete();
            return response('OK', 200);
        }
        return response('Clientenão encontrada', 404);
    }

    public function loadJson() {

        $cliente = Cliente::all();
        return json_encode($cliente);
    }
}