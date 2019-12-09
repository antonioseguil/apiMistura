<?php


namespace App\Http\Controllers;


use App\UsuarioNegocio;
use App\Utilitarios;
use Illuminate\Http\Request;

class UsuarioNegocioController extends Controller
{
    /*function index(){
        $data = UsuarioNegocio::all();
        return response()->json($data,200);
    }*/

    function create(Request $request){
        $data = $request->json()->all();
        $create = UsuarioNegocio::create([
            'ncodpersona' => $data['ncodpersona'],
            'ncodnegocio' => $data['ncodnegocio']
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    /*function update(Request $request){
        $data = $request->json()->all();
        $usuarioNegocio = UsuarioNegocio::where('ncodtipoplato',$data['ncodtipoplato'])->first();
        $usuarioNegocio->cnombretipoplato = $data['cnombretipoplato'];
        $usuarioNegocio->save();
        return response()->json($usuarioNegocio,200);
    }*/
}
