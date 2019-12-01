<?php


namespace App\Http\Controllers;


use App\Plato;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlatoController extends Controller
{
    function index(Request $request){
        $data = Plato::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        $create = Plato::create([
            'ncodtipoplato' => $data['ncodtipoplato'],
            'cnombreplato' => $data['cnombreplato'],
            'cdescresena' => $data['cdescresena'],
            'curlimagen' => $data['curlimagen']
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $plato = Plato::where('ncodplato',$data['ncodplato'])->first();
        $plato->ncodtipoplato = $data['ncodtipoplato'];
        $plato->cnombreplato = $data['cnombreplato'];
        $plato->cdescresena = $data['cdescresena'];
        $plato->curlimagen = $data['curlimagen'];
        $plato->save();
        return response()->json(Utilitarios::messageOKU($plato),200);
    }


    //función que devuelve los platos segun el evento y la seccion del evento
    function  setEventoSeccion($codevento,$codseccion){
        $data = DB::select("call sp_getPlatosSeccionEvento(?,?)",[$codevento,$codseccion]);
        return response()->json($data,200);
    }
}
