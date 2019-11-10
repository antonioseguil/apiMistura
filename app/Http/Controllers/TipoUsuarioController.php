<?php


namespace App\Http\Controllers;


use App\TipoUsuario;
use App\UsuarioTipoPermiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoUsuarioController extends Controller
{
    function index(Request $request){
        $data = TipoUsuario::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        TipoUsuario::create([
            'ctipousuario' => $data['ctipousuario']
        ]);
        //cuerp de la respuesta a devolver
        $dataRequest = array("rpta" => "1","msg"=>"dato creado correctamente","object" => $data);
        return response()->json($dataRequest,201);
    }

    function update(Request $request){
        //recuperando datos del array
        $data = $request->json()->all();
        //buscando por el id, para ver si existe
        $tipousuario = TipoUsuario::where('ncodtipousuario',$data['ncodtipousuario'])->first();
        //modificando
        $tipousuario->ctipousuario = $data['ctipousuario'];
        //guardando
        $tipousuario->save();
        $dataRequest = array("rpta" => "1","msg"=>"dato actualizado correctamente","object" => $tipousuario);
        return response()->json($dataRequest,200);
    }

    //funcion para agregar permiso a un usuario, un solo permiso
    function setPermisoUsuario(Request $request){
        $data = $request->json()->all();
        UsuarioTipoPermiso::create([
            'ncodtipousuario' => $data['ncodtipousuario'],
            'ncodpermiso' => $data['ncodpermiso']
            ]);
        $dataRequest = array("rpta" => "1","msg"=>"permiso agregado correctamente","cantidad" => "one");
        return response()->json($dataRequest,200);
    }

    //Función para agregar muchos permisos, para un usuario
    function setMorePermisoUsuario(Request $request){
        $datos = $request->json()->all();
        foreach ($datos as $data){
            UsuarioTipoPermiso::create([
                'ncodtipousuario' => $data['ncodtipousuario'],
                'ncodpermiso' => $data['ncodpermiso']
            ]);
        }
        $dataRequest = array("rpta" => "1","msg"=>"permisos agregado correctamente", "cantidad" => "much");
        return response()->json($dataRequest,200);
    }
}
