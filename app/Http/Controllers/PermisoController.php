<?php


namespace App\Http\Controllers;


use App\Permiso;
use App\Utilitarios;
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
        $create = Permiso::create([
            'cnombrepermiso' => $data['cnombrepermiso']
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    //ACTUALIZACIÓN DE PERMISO
    function update(Request $request){
        $data = $request->json()->all();
        $permiso = Permiso::where('ncodpermiso',$data['ncodpermiso'])->first();
        $permiso->cnombrepermiso = $data['cnombrepermiso'];
        $permiso->save();
        return response()->json(Utilitarios::messageOKU($permiso),200);
    }
}
