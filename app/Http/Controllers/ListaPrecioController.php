<?php


namespace App\Http\Controllers;


use App\ListaPrecio;
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
        ListaPrecio::create([
            'cnombrelista' => $data['cnombrelista'],
            'cespecificaciones' => $data['cespecificaciones']
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $listaprecio = ListaPrecio::where('ncodlistaprecio',$data['ncodlistaprecio'])->first();
        $listaprecio->cnombrelista = $data['cnombrelista'];
        $listaprecio->cespecificaciones = $data['cespecificaciones'];
        $listaprecio->save();
        return response()->json($listaprecio,200);
    }

}
