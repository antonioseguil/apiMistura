<?php


namespace App\Http\Controllers;



use App\Stand;
use Illuminate\Http\Request;

class StandController extends Controller
{
    function index(Request $request){
        if($request->isJson()){
            $data = Stand::all();
            return response()->json($data,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function create(Request $request){
        if($request->isJson()){
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
        return response()->json(['error' => 'no autorizado'],402);
    }

    function update(Request $request){
        if($request->isJson()){
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
        return response()->json(['error' => 'no autorizado'],402);
    }
}
