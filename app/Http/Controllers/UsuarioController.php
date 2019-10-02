<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    function index(Request $request){
        if($request->isJson()){
            $data = User::all();
            return response()->json($data,201);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function createUsuario(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            User::create([
                'cnombreusuario' => $data['cnombreusuario'],
                'cnombrepassword' => Hash::make($data['cnombrepassword']),
                'cnombre' => $data['cnombre'],
                'capellidopaterno' => $data['capellidopaterno'],
                'capellidomaterno' => $data['capellidomaterno'],
                'api_token' => Str::random(60)
            ]);
            return response()->json($data,201);
        }
        return response()->json(['error' => 'no autorizado'],402);

    }

    function updateUsuario(Request $request){
        if($request->isJson()){

            $data = $request->json()->all();
            $usuario = User::find($data['ncodusuario']);
            $usuario->cnombrepassword = $data['cnombrepassword'];
            $usuario->cnombre = $data['cnombre'];
            $usuario->capellidopaterno = $data['capellidopaterno'];
            $usuario->capellidomaterno = $data['capellidomaterno'];

            $usuario->save();
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function loginUsuario(Request $request){

    }
}
