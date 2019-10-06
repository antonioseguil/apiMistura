<?php


namespace App\Http\Controllers;


use App\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    function index(Request $request){
        if($request->isJson()){
            $data = Evento::all();
            return response()->json($data,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function create(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            Evento::create([
                'ncodusuario' => $data['ncodusuario'],
                'cnombreevento' => $data['cnombreevento'],
                'cnombredescripcion' => $data['cnombredescripcion'],
                'dfechainicio' => $data['dfechainicio'],
                'dfechafinal' => $data['dfechafinal'],
                'dhorainicio' => $data['dhorainicio'],
                'dhorafinal' => $data['dhorafinal'],
                'cdireccion' => $data['cdireccion'],
                'clongitud' => $data['clongitud'],
                'clatitud' => $data['clatitud']
            ]);
            return response()->json($data,201);
        }
        return response()->json(['error' => 'no autorizado'],403);
    }

    function update(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            $evento = Evento::where('ncodevento',$data['ncodevento'])->first();
            $evento->cnombreevento = $data['cnombreevento'];
            $evento->cnombredescripcion = $data['cnombredescripcion'];
            $evento->dfechainicio = $data['dfechainicio'];
            $evento->dfechafinal = $data['dfechafinal'];
            $evento->dhorainicio = $data['dhorainicio'];
            $evento->dhorafinal = $data['dhorafinal'];
            $evento->cdireccion = $data['cdireccion'];
            $evento->clongitud = $data['clongitud'];
            $evento->clatitud = $data['clatitud'];
            $evento->save();
            return response()->json($evento,200);
        }
        return response()->json(['error' => 'no autorizado'],403);
    }
}
