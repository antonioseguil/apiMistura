<?php


namespace App\Http\Controllers;


use App\ListaPrecio;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ListaPrecioController extends Controller
{

    function index(){
        $data = ListaPrecio::all();
        return response()->json(Utilitarios::messageOK($data),200);
    }

    function getListaComboStand($codstand){
        $sql = "SELECT ncodlistaprecio, cnombrelista, cespecificaciones FROM listaprecio WHERE ncodstand = $codstand";
        $data = DB::select($sql);
        return response()->json(Utilitarios::messageOK($data),200);
    }

    function getListaPlatosStandEvento($codevento,$codseccion,$stand){
        $sql = "call sp_getlistaPrecioStandEvento(?,?,?)";
        $data = DB::select($sql,[$codevento,$codseccion,$stand]);
        return response()->json(Utilitarios::messageOK($data),200);
    }

    function create(Request $request){
        //validación de datos
        $this->validate($request,[
            'ncodstand' => 'required|exists:stand',
            'cnombrelista' => 'required',
            'cespecificaciones' => 'required'

        ]);
        $data = $request->json()->all();
        $create = ListaPrecio::create([
            'ncodstand' => $data['ncodstand'],
            'cnombrelista' => $data['cnombrelista'],
            'cespecificaciones' => $data['cespecificaciones']
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    function update(Request $request){
        //validación de datos
        $this->validate($request,[
            'ncodlistaprecio' => 'required|exists:listaprecio',
            'ncodstand' => 'required|exists:stand',
            'cnombrelista' => 'required',
            'cespecificaciones' => 'required'
        ]);
        $data = $request->json()->all();
        $listaprecio = ListaPrecio::where('ncodlistaprecio',$data['ncodlistaprecio'])->first();
        $listaprecio->ncodstand = $data['ncodstand'];
        $listaprecio->cnombrelista = $data['cnombrelista'];
        $listaprecio->cespecificaciones = $data['cespecificaciones'];
        $listaprecio->save();
        return response()->json(Utilitarios::messageOKU($listaprecio),200);
    }

}
