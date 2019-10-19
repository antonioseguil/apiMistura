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
            'ncantidad' => $data['ncantidad'],
            'nprecio' => $data['nprecio']
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $detreserva = DetReserva::where('ncoddetreserva',$data['ncoddetreserva'])->first();
        $detreserva->ncoddetlistaprecio = $data['ncoddetlistaprecio'];
        $detreserva->ncodreserva = $data['ncodreserva'];
        $detreserva->ncantidad = $data['ncantidad'];
        $detreserva->nprecio = $data['nprecio'];
        $detreserva->save();
        return response()->json($detreserva,200);
    }

}
