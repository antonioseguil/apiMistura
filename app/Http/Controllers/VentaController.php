<?php


namespace App\Http\Controllers;

use App\Utilitarios;
use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{

    function index(){
        $data = Venta::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        //capturamos los valores enviados
        $data = $request->json()->all();
        //validamos los valores
        $this->validate($request,[
            'ncodreserva' => 'required|exists:reserva,ncodreserva',
        ]);
        //insertamos valores
        DB::select("call sp_venta(?)",[$data['ncodreserva']]);
        //recuperamos el ultimo valor insertado

        $venta = Venta::all()->last();
        return response()->json(Utilitarios::messageOKC($venta) ,201);
    }
}
