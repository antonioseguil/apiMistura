<?php


namespace App\Http\Controllers;


use App\Negocio;
use App\Utilitarios;
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
        $create = Negocio::create([
            'crazonsocial' => $data['crazonsocial'],
            'cnombredescripcion' => $data['cnombredescripcion'],
            'cdireccion' => $data['cdireccion'],
            'cruc' => $data['cruc']
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    //Función actualizar un negocio
    function update(Request $request){
        $data = $request->json()->all();
        $negocio = Negocio::where('ncodnegocio',$data['ncodnegocio'])->first();
        $negocio->crazonsocial = $data['crazonsocial'];
        $negocio->cnombredescripcion = $data['cnombredescripcion'];
        $negocio->cdireccion = $data['cdireccion'];
        $negocio->save();
        return response()->json(Utilitarios::messageOKU($negocio),200);
    }
    // -- la función para agregar un usuario al negocio esta en un controlador aparte...

    //TODO* FALTA FUNCTION PARA CAMBIAR EL ESTADO DE UN NEGOCIO
}
