<?php


namespace App\Http\Controllers;


use App\Permiso;
use Illuminate\Http\Request;


class PermisoController extends Controller
{

    //DEVOLVER LISTA DE PERMISOS
    function index(Request $request){
        $data = Permiso::all();
        return response()->json($data,200);
    }

    //CREACION DE PERMISO
    function create(Request $request){
        $data = $request->json()->all();
        Permiso::create([
            'cnombrepermiso' => $data['cnombrepermiso']
        ]);
        $dataRequest = array("rpta" => "1","msg"=>"creado correctamente", "objeto" => $data);
        return response()->json($dataRequest,201);
    }

    //ACTUALIZACIÓN DE PERMISO
    function update(Request $request){
        $data = $request->json()->all();
        $permiso = Permiso::where('ncodpermiso',$data['ncodpermiso'])->first();
        $permiso->cnombrepermiso = $data['cnombrepermiso'];
        $permiso->save();
        $dataRequest = array("rpta" => "1","msg"=>"actualizado correctamente", "objeto" => $data);
        return response()->json($dataRequest,200);
    }
}
