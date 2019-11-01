<?php


namespace App\Http\Controllers;


use App\TipoUsuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    function index(Request $request){
        $data = TipoUsuario::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        TipoUsuario::create([
            'ctipousuario' => $data['ctipousuario']
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $tipousuario = TipoUsuario::where('ncodtipousuario',$data['ncodtipousuario'])->first();
        $tipousuario->ctipousuario = $data['ctipousuario'];
        $tipousuario->save();
        return response()->json($tipousuario,200);
    }
}
