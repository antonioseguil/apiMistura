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

    //funcion para crear una reserva
    function create(Request $request){
        $data = $request->json()->all();
        //INSTANCIA PARA LA FECHA
        $time = new \DateTime();
        $create = Reserva::create([
            'ncodpersona' => $data['ncodpersona'],
            'ncantidadtotal' => '0',
            'dfechareserva' => $time->format('Y-m-d')
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    //función para actualizar la cantidad total
    function update(Request $request){
        $data = $request->json()->all();
        $reserva = Reserva::where('ncodreserva',$data['ncodreserva'])->first();
        $reserva->ncantidadtotal = $data['ncantidadtotal'];
        $reserva->save();
        return response()->json(Utilitarios::messageOKU($reserva),200);
    }

    //funcion para cambiar de estado de la reserva
    /*
     * ESTADOS DE LA RESERVA
     * R = RESERVADO
     * E = ENTREGADO
     * C = CANCELADO
     * */
    function reservaStatusEntregado($codreserva){
        $reserva = Reserva::where('ncodreserva',$codreserva)->first();
        $reserva->cestado = 'E';
        return response()->json(Utilitarios::messageOK($reserva),200);
    }

    function reservaStatusCancelado($codreserva){
        $reserva = Reserva::where('ncodreserva',$codreserva)->first();
        $reserva->cestado = 'C';

        return response()->json(Utilitarios::messageOK($reserva),200);
    }
}
