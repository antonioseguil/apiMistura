<?php


namespace App\Http\Controllers;


use App\Reserva;
use App\Utilitarios;
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
        $create = Reserva::create([
            'ncodpersona' => $data['ncodpersona'],
            'ncantidadtotal' => $data['ncantidadtotal'],
            'dfechareserva' => $time->format('Y-m-d')
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    //función para actializar la cantidad total
    function update(Request $request){
        $data = $request->json()->all();
        $reserva = Reserva::where('ncodreserva',$data['ncodreserva'])->first();
        $reserva->ncantidadtotal = $data['ncantidadtotal'];
        $reserva->save();
        return response()->json(Utilitarios::messageOKU($reserva),200);
    }

    //falta function para cambiar el estado de la reserva
}
