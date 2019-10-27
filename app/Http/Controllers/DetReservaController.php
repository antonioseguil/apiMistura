<?php


namespace App\Http\Controllers;


use App\DetReserva;
use Illuminate\Http\Request;

class DetReservaController extends Controller
{

    function index(){
        $data = DetReserva::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        DetReserva::create([
            'ncoddetlistaprecio' => $data['ncoddetlistaprecio'],
            'ncodreserva' => $data['ncodreserva'],
            'ncantidad' => $data['ncantidad']
        ]);
        return response()->json($data,201);
    }

    //TODO* falta revision de update
    function update(Request $request){
        $data = $request->json()->all();
        $detreserva = DetReserva::where('ncoddetreserva',$data['ncoddetreserva'])->first();
        $detreserva->ncoddetlistaprecio = $data['ncoddetlistaprecio'];
        $detreserva->ncodreserva = $data['ncodreserva'];
        $detreserva->ncantidad = $data['ncantidad'];
        $detreserva->save();
        return response()->json($detreserva,200);
    }

}
