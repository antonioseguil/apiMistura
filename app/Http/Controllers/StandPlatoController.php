<?php


namespace App\Http\Controllers;


use App\StandPlato;
use Illuminate\Http\Request;
// TODO - PROBLEMA QUE EL STAND PLATO NO TENGA ID, HABLAR CON DELEGADA PARA AGREGAR CODIGO A LA TABLA
class StandPlatoController extends Controller
{
    function index(){
        $data = StandPlato::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        StandPlato::create([
            'ncodstand' => $data['ncodstand'],
            'ncodstand' => $data['ncodstand'],
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $usuarioTipoPermiso = StandPlato::where('ncodtipousuariopermiso',$data['ncodtipousuariopermiso'])->first();
        $usuarioTipoPermiso->ncodpermiso = $data['ncodpermiso'];
        $usuarioTipoPermiso->save();
        return response()->json($data,200);
    }
}
