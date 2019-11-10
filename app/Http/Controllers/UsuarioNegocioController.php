<?php


namespace App\Http\Controllers;


use App\UsuarioNegocio;
use Illuminate\Http\Request;

class UsuarioNegocioController extends Controller
{
    /*function index(){
        $data = UsuarioNegocio::all();
        return response()->json($data,200);
    }*/

    function create(Request $request){
        $data = $request->json()->all();
        UsuarioNegocio::create([
            'ncodpersona' => $data['ncodpersona'],
            'ncodnegocio' => $data['ncodnegocio']
        ]);
        $dataRequest = array("rpta" => "1","msg"=>"creado correctamente", "objeto" => $data);
        return response()->json($dataRequest,201);
    }

    /*function update(Request $request){
        $data = $request->json()->all();
        $usuarioNegocio = UsuarioNegocio::where('ncodtipoplato',$data['ncodtipoplato'])->first();
        $usuarioNegocio->cnombretipoplato = $data['cnombretipoplato'];
        $usuarioNegocio->save();
        return response()->json($usuarioNegocio,200);
    }*/
}
