<?php


namespace App\Http\Controllers;


use App\DetReserva;
use App\Reserva;
use App\Utilitarios;
use Illuminate\Http\Request;

class DetReservaController extends Controller
{

    //TODO* FALTA CREAR METODO PARA AGREGAR VARIOS DETALLES DE UNA RESERVA

    function index(){
        $data = DetReserva::all();
        return response()->json($data,200);
    }

    //función para crear una nueva reserva
    function create(Request $request){
        $data = $request->json()->all();
        //buscamos la reserva al cual se le va actualizar el dato
        $reserva = Reserva::where('ncodreserva',$data['ncodreserva'])->first();
        //variable que contara la cantidad total que se esta registrando
        $cantidadTotal = $reserva->ncantidadtotal;
        $create = DetReserva::create([
            'ncoddetlistaprecio' => $data['ncoddetlistaprecio'],
            'ncodreserva' => $data['ncodreserva'],
            'ncantidad' => $data['ncantidad']
        ]);
        $cantidadTotal = $cantidadTotal + $data['ncantidad'];
        //actualizamos la nueva cantidad total
        $reserva->ncantidadtotal = $cantidadTotal;
        //guarda los cambios
        $reserva->save();
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    //función para actualizar el detalle de una reserva
    function update(Request $request){
        $data = $request->json()->all();
        $detreserva = DetReserva::where('ncoddetreserva',$data['ncoddetreserva'])->first();
        $detreserva->ncoddetlistaprecio = $data['ncoddetlistaprecio'];
        $detreserva->ncantidad = $data['ncantidad'];
        $detreserva->save();
        return response()->json(Utilitarios::messageOKU($detreserva),200);
    }

}
