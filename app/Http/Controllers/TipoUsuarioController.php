<?php


namespace App\Http\Controllers;


use App\TipoUsuario;
use App\UsuarioTipoPermiso;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoUsuarioController extends Controller
{
    function index(Request $request){
        $data = TipoUsuario::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        //validación de datos
        $this->validate($request,[
            'ctipousuario' => 'required',
        ]);
        $data = $request->json()->all();
        $create = TipoUsuario::create([
            'ctipousuario' => $data['ctipousuario']
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    function update(Request $request){
        //validación de datos
        $this->validate($request,[
            'ncodtipousuario' => 'required|exists:tipousuario',
            'ctipousuario' => 'required',
        ]);
        //recuperando datos del array
        $data = $request->json()->all();
        //buscando por el id, para ver si existe
        $tipousuario = TipoUsuario::where('ncodtipousuario',$data['ncodtipousuario'])->first();
        //modificando
        $tipousuario->ctipousuario = $data['ctipousuario'];
        //guardando
        $tipousuario->save();
        return response()->json(Utilitarios::messageOKU($tipousuario),200);
    }

    //funcion para agregar permiso a un usuario, un solo permiso
    function setPermisoUsuario(Request $request){
        //validación de datos
        $this->validate($request,[
            'ncodtipousuario' => 'required|exists:tipousuario',
            'ncodpermiso' => 'required:exists:permiso',
        ]);
        $data = $request->json()->all();
        $create = UsuarioTipoPermiso::create([
            'ncodtipousuario' => $data['ncodtipousuario'],
            'ncodpermiso' => $data['ncodpermiso']
            ]);
        return response()->json(Utilitarios::messageMoreData($create),200);
    }

    //Función para agregar muchos permisos, para un usuario
    function setMorePermisoUsuario(Request $request){
        $datos = $request->json()->all();
        //variables que contiene los datos creados
        $returnData = array();
        foreach ($datos as $data){
            $create = UsuarioTipoPermiso::create([
                'ncodtipousuario' => $data['ncodtipousuario'],
                'ncodpermiso' => $data['ncodpermiso']
            ]);
            array_push($returnData,$create);
        }
        return response()->json(Utilitarios::messageMoreData($returnData,count($returnData)),200);
    }
}
