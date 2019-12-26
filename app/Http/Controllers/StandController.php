<?php


namespace App\Http\Controllers;



use App\Stand;
use App\Utilitarios;
use Illuminate\Http\Request;

class StandController extends Controller
{
    //FUNCIONES PARA DEVOLVER DATOS
    //función que devuelve todos los datos del stand
    function index(){
        $data = Stand::all();
        return response()->json($data,200);
    }

    //Función para regresar todos los STAND segun su estado
    function getStandStatus($status){
        $data = Stand::where('cestado',strtoupper($status))->get();
        return response()->json(Utilitarios::messageOK($data),200);
    }

    //-----------------------------------------------------------

    //función para agregar un nuevo stand, recibe dato json
    function create(Request $request){
        //recogiendo la data
        $data = $request->json()->all();
        //validando datos
        $this->validate($request,[
            'ncodevento' => 'required|exists:evento|integer',
            'ncodnegocio' => 'required|exists:negocio|integer',
            'ncodseccionstand' => 'required:exists:seccionstand|integer',
            'cnumerosstand' => 'required',
            'clongitud' => 'required',
            'clatitud' => 'required',
        ]);

        //creano el stand nuevo
        $create = Stand::create([
            'ncodevento' => $data['ncodevento'],
            'ncodnegocio' => $data['ncodnegocio'],
            'ncodseccionstand' => $data['ncodseccionstand'],
            'cnumerosstand' => $data['cnumerosstand'],
            'clongitud' => $data['clongitud'],
            'clatitud' => $data['clatitud']
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    //función para actualizar
    function update(Request $request){
        $data = $request->json()->all();
        $this->validate($request,[
            'ncodstand' => 'required|exists:stand',
            'cnumerosstand' => 'required',
            'clongitud' => 'required',
            'clatitud' => 'required',
        ]);
        $stand = Stand::where('ncodstand',$data['ncodstand'])->first();
        $stand->cnumerosstand = $data['cnumerosstand'];
        $stand->clongitud = $data['clongitud'];
        $stand->clatitud = $data['clatitud'];
        $stand->save();
        return response()->json(Utilitarios::messageOKU($stand),200);
    }

    //funcion para cambiar de estado al stand
    /*
     * ESTADOS DEL STAND
     * A = ACTIVO, QUE ESTA FUNCIONANDO
     * D = DESABILITADO
     * */
    function standDelete($codstand){
        $stand = Stand::where('ncodstand',$codstand)->first();
        $stand->cestado = 'D';
        $stand->save();
        return response()->json(Utilitarios::messageOK($stand),200);
    }
}
