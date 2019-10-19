<?php


namespace App\Http\Controllers;


use App\UsuarioTipoPermiso;
use Illuminate\Http\Request;

class UsuarioTipoPermisoController extends Controller
{
    function index(Request $request){
        $data = UsuarioTipoPermiso::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        UsuarioTipoPermiso::create([
            'ncodtipousuario' => $data['ncodtipousuario'],
            'ncodpermiso' => $data['ncodpermiso'],
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $usuarioTipoPermiso = UsuarioTipoPermiso::where('ncodtipousuariopermiso',$data['ncodtipousuariopermiso'])->first();
        $usuarioTipoPermiso->ncodpermiso = $data['ncodpermiso'];
        $usuarioTipoPermiso->save();
        return response()->json($data,200);
    }
}
