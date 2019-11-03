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

    //función que crea un nuevo negocio
    function create(Request $request){
        $data = $request->json()->all();
        Negocio::create([
            'crazonsocial' => $data['crazonsocial'],
            'cnombredescripcion' => $data['cnombredescripcion'],
            'cdireccion' => $data['cdireccion'],
            'cruc' => $data['cruc']
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $negocio = Negocio::where('ncodnegocio',$data['ncodnegocio'])->first();
        $negocio->cnombrenegocio = $data['cnombrenegocio'];
        $negocio->cnombredescripcion = $data['cnombredescripcion'];
        $negocio->cdireccion = $data['cdireccion'];
        $negocio->save();
        return response()->json($negocio,200);
    }

    //TODO* FALTA FUNCTION PARA CAMBIAR EL ESTADO DE UN NEGOCIO
}
