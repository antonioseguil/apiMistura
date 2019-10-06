<?php


namespace App\Http\Controllers;


use App\TipoUsuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    function index(Request $request){
        if($request->isJson()){
            $data = TipoUsuario::all();
            return response()->json($data,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function create(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            TipoUsuario::create([
                'ctipousuario' => $data['ctipousuario']
            ]);
            return response()->json($data,201);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function update(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            $tipousuario = TipoUsuario::where('ncodtipousuario',$data['ncodtipousuario'])->first();
            $tipousuario->ctipousuario = $data['ctipousuario'];
            $tipousuario->save();
            return response()->json($tipousuario,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }
}
