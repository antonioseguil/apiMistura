<?php


namespace App\Http\Controllers;


use App\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{

    /*function index(){
        $data = Venta::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        Venta::create([
            'ncodreserva' => $data['ncodcliente'],
            'cserie' => $data['cserie'],
            'cnumero' => $data['cnumero'],
            'dfechaemision' => $data['dfechaemision'],
            'dhoraemision' => $data['dhoraemision'],
            'estado' => $data['estado']
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $venta = Venta::where('ncodventa',$data['ncodventa'])->first();
        $venta->ncodcliente = $data['ncodcliente'];
        $venta->ncantidadtotal = $data['ncantidadtotal'];
        $venta->dfechareserva = $data['dfechareserva'];
        $venta->save();
        return response()->json($venta,200);
    }*/
}
