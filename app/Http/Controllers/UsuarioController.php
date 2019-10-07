<?php


namespace App\Http\Controllers;


use App\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class UsuarioController extends Controller
{
    function index(Request $request){
//        if($request->isJson()){
//            $data = User::all();
//            return response()->json($data,200);
//        }
//        return response()->json(['error' => 'no autorizado'],402);

        $data = User::all();
        return response()->json($data,200);

    }

    function create(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            User::create([
                'cusuario' => $data['cusuario'],
                'cpassword' => Hash::make($data['cpassword']),
                'cnombre' => $data['cnombre'],
                'capellidopaterno' => $data['capellidopaterno'],
                'capellidomaterno' => $data['capellidomaterno'],
                'api_token' => Str::random(60),
                'ncodtipousuario' => $data['ncodtipousuario']
            ]);
            return response()->json($data,201);
        }
        return response()->json(['error' => 'no autorizado'],402);

    }

    function update(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            $usuario = User::where('ncodusuario',$data['ncodusuario'])->first();
            $usuario->cnombre = $data['cnombre'];
            $usuario->capellidopaterno = $data['capellidopaterno'];
            $usuario->capellidomaterno = $data['capellidomaterno'];
            $usuario->save();
            return response()->json($usuario,200);
        }
        return response()->json(['error' => 'no autorizado'],403);
    }

    function getToken(Request $request){
        if($request->isJson()){
            try{
                $data = $request->json()->all();
                $user = User::where('cusuario',$data['cusuario'])->first();
                if($user && Hash::check($data['cpassword'],$user->cpassword)){
                    return response()->json($user,200);
                }/*else{
                    return response()->json(['error'=>'no content'],406);
                }*/
            }catch (ModelNotFoundException $exception){
                return response()->json(['error'=>'no content'],406);
            }
        }
        return response()->json(['error' => 'no autorizado'],403);
    }
}
