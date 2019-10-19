<?php


namespace App\Http\Controllers;


use App\DetListaPrecio;
use Illuminate\Http\Request;

class DetListaPrecioController extends Controller
{

    function index(Request $request){
        $data = DetListaPrecio::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        DetListaPrecio::create([
            'ncodlistaprecio' => $data['ncodlistaprecio'],
            'ncodplato' => $data['ncodplato'],
            'cprecio' => $data['cprecio']
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $detlistaprecio = DetListaPrecio::where('ncoddetlistaprecio',$data['ncoddetlistaprecio'])->first();
        $detlistaprecio->ncodlistaprecio = $data['ncodlistaprecio'];
        $detlistaprecio->ncodplato = $data['ncodplato'];
        $detlistaprecio->cprecio = $data['cprecio'];
        $detlistaprecio->save();
        return response()->json($detlistaprecio,200);
    }

}
