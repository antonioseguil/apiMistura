<?php


namespace App\Http\Controllers;


use App\ListaPrecio;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ListaPrecioController extends Controller
{

    function index(Request $request){
        $data = ListaPrecio::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        $create = ListaPrecio::create([
            'ncodstand' => $data['ncodstand'],
            'cnombrelista' => $data['cnombrelista'],
            'cespecificaciones' => $data['cespecificaciones']
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $listaprecio = ListaPrecio::where('ncodlistaprecio',$data['ncodlistaprecio'])->first();
        $listaprecio->ncodstand = $data['ncodstand'];
        $listaprecio->cnombrelista = $data['cnombrelista'];
        $listaprecio->cespecificaciones = $data['cespecificaciones'];
        $listaprecio->save();
        return response()->json(Utilitarios::messageOKU($listaprecio),200);
    }

    //TODO* Falta función que busque la lista de precio de un plato

}
