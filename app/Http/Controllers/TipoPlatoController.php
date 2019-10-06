<?php


namespace App\Http\Controllers;


use App\TipoPlato;
use Illuminate\Http\Request;

class TipoPlatoController extends Controller
{
    function index(Request $request){
        if($request->isJson()){
            $data = TipoPlato::all();
            return response()->json($data,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function create(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            TipoPlato::create([
                'cnombretipoplato' => $data['cnombretipoplato']
            ]);
            return response()->json($data,201);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function update(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            $tipoplato = TipoPlato::where('ncodtipoplato',$data['ncodtipoplato'])->first();
            $tipoplato->cnombretipoplato = $data['cnombretipoplato'];
            $tipoplato->save();
            return response()->json($tipoplato,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }
}
