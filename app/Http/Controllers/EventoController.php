<?php


namespace App\Http\Controllers;


use App\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    //TODO * FALTA VERIFICAR EL CAMPO DE "CESTADO" EN LOS CONTROLADORES

    //función para regresar todos lo datos de la tabla
    function index(Request $request){
        $data = Evento::all();
        return response()->json($data,200);
    }

    function create(Request $request){
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

    function update(Request $request){
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

    //TODO * AGREGAR FUNCIÓNES PARA BUSCAR EVENTOS
}
