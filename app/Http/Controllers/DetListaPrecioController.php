<?php


namespace App\Http\Controllers;


use App\DetListaPrecio;
use App\Utilitarios;
use Hamcrest\Util;
use Illuminate\Http\Request;

class DetListaPrecioController extends Controller
{

    //función para retornar toda la lista de detalles
    function index(Request $request){
        $data = DetListaPrecio::all();
        return response()->json($data,200);
    }

    //función para crear un nuevo detalle
    function create(Request $request){
        //recuperamos los datos json enviados
        $data = $request->json()->all();
        $create = DetListaPrecio::create([
            'ncodlistaprecio' => $data['ncodlistaprecio'],
            'ncodplato' => $data['ncodplato'],
            'cprecio' => $data['cprecio']
        ]);
        return response()->json(Utilitarios::messageMoreData($create),201);
    }

    //functión para crear varios detalles de lista de precio
    function moreCreate(Request $request){
        //varible de respuesta
        $returnData = array();
        $datos = $request->json()->all();
        //recorremos los datos que se han enviado
        foreach ($datos as $data) {
            $create = DetListaPrecio::create([
                'ncodlistaprecio' => $data['ncodlistaprecio'],
                'ncodplato' => $data['ncodplato'],
                'cprecio' => $data['cprecio']
            ]);
            array_push($returnData,$create);
        }
        return response()->json(Utilitarios::messageMoreData($returnData,count($returnData)),201);
    }



    //función para actualizar un nuevo detalle
    function update(Request $request){
        $data = $request->json()->all();
        $detlistaprecio = DetListaPrecio::where('ncoddetlistaprecio',$data['ncoddetlistaprecio'])->first();
        $detlistaprecio->ncodlistaprecio = $data['ncodlistaprecio'];
        $detlistaprecio->ncodplato = $data['ncodplato'];
        $detlistaprecio->cprecio = $data['cprecio'];
        $detlistaprecio->save();
        return response()->json(Utilitarios::messageOKU($detlistaprecio),200);
    }

}
