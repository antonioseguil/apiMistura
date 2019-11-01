<?php


namespace App\Http\Controllers;


use App\TipoPlato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoPlatoController extends Controller
{
    function index(Request $request){
        $data = TipoPlato::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        TipoPlato::create([
            'cnombretipoplato' => $data['cnombretipoplato']
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $tipoplato = TipoPlato::where('ncodtipoplato',$data['ncodtipoplato'])->first();
        $tipoplato->cnombretipoplato = $data['cnombretipoplato'];
        $tipoplato->save();
        return response()->json($tipoplato,200);
    }
/*
 * funcion que usa el store procedure de mysql
 *  function spPrueba(Request $request){
        if($request->isJson()){
            $data = DB::select('call sp_prueba()');
            return response()->json($data,200);
        }
    }

 */
}
