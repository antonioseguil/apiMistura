<?php


namespace App\Http\Controllers;


use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClienteController extends Controller
{

    function index(Request $request){
        $data = Cliente::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        Cliente::create([
            'cusuario' => $data['cusuario'],
            'cpassword' => Hash::make($data['cpassword']),
            'cnombre' => $data['cnombre'],
            'capellidopaterno' => $data['capellidopaterno'],
            'capellidomaterno' => $data['capellidomaterno'],
            'cdni' => $data['cdni'],
            'ccorreo' => $data['ccorreo'],
            'api_token' => Str::random(60)
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $cliente = Cliente::where('ncodcliente',$data['ncodcliente'])->first();
        $cliente->cnombre = $data['cnombre'];
        $cliente->capellidopaterno = $data['capellidopaterno'];
        $cliente->capellidomaterno = $data['capellidomaterno'];
        $cliente->save();
        return response()->json($cliente,200);
    }

}
