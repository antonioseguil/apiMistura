<?php


namespace App\Http\Controllers;


use App\Permiso;
use Illuminate\Http\Request;


class PermisoController extends Controller
{
    function index(Request $request){
        $data = Permiso::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        Permiso::create([
            'cnombrepermiso' => $data['cnombrepermiso']
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $permiso = Permiso::where('ncodpermiso',$data['ncodpermiso'])->first();
        $permiso->cnombrepermiso = $data['cnombrepermiso'];
        $permiso->save();
        return response()->json($permiso,200);
    }
}
