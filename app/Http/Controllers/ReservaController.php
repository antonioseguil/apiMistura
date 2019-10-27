<?php


namespace App\Http\Controllers;


use App\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    function index(){
        $data = Reserva::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        //INSTANCIA PARA LA FECHA
        $time = new \DateTime();
        Reserva::create([
            'ncodcliente' => $data['ncodcliente'],
            'ncantidadtotal' => $data['ncantidadtotal'],
            'dfechareserva' => $time->format('Y-m-d')
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $reserva = Reserva::where('ncodreserva',$data['ncodreserva'])->first();
        $reserva->ncodcliente = $data['ncodcliente'];
        $reserva->ncantidadtotal = $data['ncantidadtotal'];
        $reserva->save();
        return response()->json($reserva,200);
    }
}
