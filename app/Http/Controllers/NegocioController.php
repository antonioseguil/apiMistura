<?php


namespace App\Http\Controllers;


use App\Negocio;
use Illuminate\Http\Request;

class NegocioController extends Controller
{

    //función para devolver todos los datos de la tabla
    function index(Request $request){
        $data = Negocio::all();
        return response()->json($data,200);
    }

    //Función que crea un nuevo negocio
    function create(Request $request){
        $data = $request->json()->all();
        Negocio::create([
            'crazonsocial' => $data['crazonsocial'],
            'cnombredescripcion' => $data['cnombredescripcion'],
            'cdireccion' => $data['cdireccion'],
            'cruc' => $data['cruc']
        ]);
        $dataRequest = array("rpta" => "1","msg"=>"creado correctamente","objeto" => $data);
        return response()->json($dataRequest,201);
    }

    //Función actualizar un negocio
    function update(Request $request){
        $data = $request->json()->all();
        $negocio = Negocio::where('ncodnegocio',$data['ncodnegocio'])->first();
        $negocio->crazonsocial = $data['crazonsocial'];
        $negocio->cnombredescripcion = $data['cnombredescripcion'];
        $negocio->cdireccion = $data['cdireccion'];
        $negocio->save();
        $dataRequest = array("rpta" => "1","msg"=>"actualizado correctamente", "objeto" => $negocio);
        return response()->json($dataRequest,200);
    }
    //TODO* AGREGAR FUNCIÓN PARA AGREGAR USUARIO_NEGOCIO

    //TODO* FALTA FUNCTION PARA CAMBIAR EL ESTADO DE UN NEGOCIO
}
