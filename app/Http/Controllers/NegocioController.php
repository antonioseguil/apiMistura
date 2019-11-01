<?php


namespace App\Http\Controllers;


use App\Negocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NegocioController extends Controller
{
    function index(Request $request){
        $data = Negocio::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        Negocio::create([
            'cnombrenegocio' => $data['cnombrenegocio'],
            'cnombredescripcion' => $data['cnombredescripcion'],
            'cdireccion' => $data['cdireccion'],
            'cnombreusuario' => $data['cnombreusuario'],
            'cpassword' => Hash::make(($data['cpassword'])),
            'ncantidadusuarios' => $data['ncantidadusuarios']
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $negocio = Negocio::where('ncodnegocio',$data['ncodnegocio'])->first();
        $negocio->cnombrenegocio = $data['cnombrenegocio'];
        $negocio->cnombredescripcion = $data['cnombredescripcion'];
        $negocio->cdireccion = $data['cdireccion'];
        $negocio->save();
        return response()->json($negocio,200);
    }
}
