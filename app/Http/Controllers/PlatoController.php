<?php


namespace App\Http\Controllers;


use App\Plato;
use Illuminate\Http\Request;

class PlatoController extends Controller
{
    function index(Request $request){
        if($request->isJson()){
            $data = Plato::all();
            return response()->json($data,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function create(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            Plato::create([
                'ncodtipoplato' => $data['ncodtipoplato'],
                'cnombreplato' => $data['cnombreplato'],
                'cdescresena' => $data['cdescresena'],
                'curlimagen' => $data['curlimagen']
            ]);
            return response()->json($data,201);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function update(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            $plato = Plato::where('ncodplato',$data['ncodplato'])->first();
            $plato->ncodtipoplato = $data['ncodtipoplato'];
            $plato->cnombreplato = $data['cnombreplato'];
            $plato->cdescresena = $data['cdescresena'];
            $plato->curlimagen = $data['curlimagen'];
            $plato->save();
            return response()->json($plato,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }
}
