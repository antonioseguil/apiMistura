<?php


namespace App\Http\Controllers;


use App\TipoPlato;
use App\Utilitarios;
use Illuminate\Http\Request;

class TipoPlatoController extends Controller
{
    function index(Request $request){
        $data = TipoPlato::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        //validación de datos
        $this->validate($request,[
            'cnombretipoplato' => 'required',
        ]);
        //recuperamos datos
        $data = $request->json()->all();
        //creamos el nuevo dato en la bd y lo guardamos en un variable
        $create = TipoPlato::create([
            'cnombretipoplato' => $data['cnombretipoplato']
        ]);
        //retornando datos correpondientes
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    function update(Request $request){
        //validación de datos
        $this->validate($request,[
            'ncodtipoplato' => 'required',
            'cnombretipoplato' => 'required',
        ]);
        $data = $request->json()->all();
        $tipoplato = TipoPlato::where('ncodtipoplato',$data['ncodtipoplato'])->first();
        $tipoplato->cnombretipoplato = $data['cnombretipoplato'];
        $tipoplato->save();
        return response()->json(Utilitarios::messageOKU($tipoplato),200);
    }
}
