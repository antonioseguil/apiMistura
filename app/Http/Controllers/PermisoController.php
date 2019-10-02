<?php


namespace App\Http\Controllers;


use App\Permiso;
use Illuminate\Http\Request;


class PermisoController extends Controller
{
    function index(Request $request){
        if($request->isJson()){
            $data = Permiso::all();
            return response()->json($data,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function createPermiso(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            Permiso::create([
                'cnombrepermiso' => $data['cnombrepermiso']
            ]);
            return response()->json($data,201);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function updatePermiso(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            $permiso = Permiso::where('ncodpermiso',$data['ncodpermiso'])->first();
            $permiso->cnombrepermiso = $data['cnombrepermiso'];
            $permiso->save();
            return response()->json($permiso,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }
}
