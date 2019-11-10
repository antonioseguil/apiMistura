<?php


namespace App\Http\Controllers;



use App\Stand;
use Illuminate\Http\Request;

class StandController extends Controller
{
    //TODO * falta agregar las consultas
    //TODO* FALTA FILTRAR EL INDEX PARA QUE DEVUELVA LOS DATOS DE ESTADO = a

    //función que devuelve todos los datos del stand
    function index(Request $request){
        $data = Stand::all();
        return response()->json($data,200);
    }

    //función para agregar un nuevo stand, recibe dato json
    function create(Request $request){
        $data = $request->json()->all();
        Stand::create([
            'ncodevento' => $data['ncodevento'],
            'ncodnegocio' => $data['ncodnegocio'],
            'ncodseccionstand' => $data['ncodseccionstand'],
            'cnumerosstand' => $data['cnumerosstand'],
            'clongitud' => $data['clongitud'],
            'clatitud' => $data['clatitud']
        ]);
        $dataRequest = array("rpta" => "1","msg"=>"creado correctamente", "objeto" => $data);
        return response()->json($dataRequest,201);
    }

    //función para actualizar
    function update(Request $request){
        $data = $request->json()->all();
        $stand = Stand::where('ncodstand',$data['ncodstand'])->first();
        $stand->cnumerosstand = $data['cnumerosstand'];
        $stand->clongitud = $data['clongitud'];
        $stand->clatitud = $data['clatitud'];
        $stand->save();
        $dataRequest = array("rpta" => "1","msg"=>"actualizado correctamente", "objeto" => $stand);
        return response()->json($dataRequest,200);
    }

    //TODO FALTA FUNCION PARA CAMBIAR EL ESTADO DEL STAND
}
