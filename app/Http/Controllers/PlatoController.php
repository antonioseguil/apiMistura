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
        //validación de datos
        $this->validate($request,[
            'ncodtipoplato' => 'required|exists:tipoplato',
            'cnombreplato' => 'required',
            'cdescresena' => 'required',
            'curlimagen' => 'required',
        ]);
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
        //validación de datos
        $this->validate($request,[
            'ncodplato' => 'required|exists:plato',
            'ncodtipoplato' => 'required|exists:tipoplato',
            'cnombreplato' => 'required',
            'cdescresena' => 'required',
            'curlimagen' => 'required',
        ]);
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
        //consultado al DB
        $platos = DB::select("call sp_getPlatosSeccionEvento(?,?)",[$codevento,$codseccion]);
        //array de datos
        $data = array();
        //agregando la segunda consulta a los datos
        foreach ($platos as $plato) {
            $d = array(
                "ncodplato" => $plato->ncodplato,
                "ncodlistaprecio" => $plato->ncodlistaprecio,
                "cnombreplato" => $plato->cnombreplato,
                "cdescresena" => $plato->cdescresena,
                "curlimagen" => $plato->curlimagen,
                "cprecio" => $plato->cprecio,
                "detalle" => DB::select("call sp_getDetallePlato(?,?)",[$plato->ncodplato,$plato->ncodlistaprecio]),
            );
            array_push($data,$d);
        }
        return response()->json($data,200);
    }

    //function para traer todos los platos en un order ascendente segun la seccion enviada
    function getAllPlatosAsc($codseccion){
        //consultado al DB
        $platos = DB::select("call sp_getPlatos(?)",[$codseccion]);
        //array de datos
        $data = array();
        //agregando la segunda consulta a los datos
        foreach ($platos as $plato) {
            $d = array(
                "ncodplato" => $plato->ncodplato,
                "ncodlistaprecio" => $plato->ncodlistaprecio,
                "cnombreplato" => $plato->cnombreplato,
                "cdescresena" => $plato->cdescresena,
                "curlimagen" => $plato->curlimagen,
                "cprecio" => $plato->cprecio,
                "detalle" => DB::select("call sp_getDetallePlato(?,?)",[$plato->ncodplato,$plato->ncodlistaprecio]),
            );
            array_push($data,$d);
        }
        return response()->json($data,200);
    }
}
