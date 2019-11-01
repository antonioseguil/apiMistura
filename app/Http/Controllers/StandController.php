<?php


namespace App\Http\Controllers;



use App\Stand;
use Illuminate\Http\Request;

class StandController extends Controller
{
    //TODO * falta agregar las consultas

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
            'ccalificacion' => $data['ccalificacion'],
            'clongitud' => $data['clongitud'],
            'clatitud' => $data['clatitud']
        ]);
        return response()->json($data,201);
    }

    //función para actualizar
    function update(Request $request){
        $data = $request->json()->all();
        $stand = Stand::where('ncodstand',$data['ncodstand'])->first();
        $stand->ncodevento = $data['ncodevento'];
        $stand->ncodnegocio = $data['ncodnegocio'];
        $stand->ncodseccionstand = $data['ncodseccionstand'];
        $stand->cnumerosstand = $data['cnumerosstand'];
        $stand->ccalificacion = $data['ccalificacion'];
        $stand->clongitud = $data['clongitud'];
        $stand->clatitud = $data['clatitud'];
        $stand->save();
        return response()->json($stand,200);
    }
}
