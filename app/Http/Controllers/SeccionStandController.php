<?php


namespace App\Http\Controllers;


use App\SeccionStand;
use Illuminate\Http\Request;

class SeccionStandController extends Controller
{
    //funcion para devolver todos las secciones
    function index(Request $request){
        $data = SeccionStand::all();
        return response()->json($data,200);
    }

    //función para crear una nueva seccion
    function create(Request $request){
        $data = $request->json()->all();
        SeccionStand::create([
            'cseccion' => $data['cseccion'],
            'cdescripcion' => $data['cdescripcion']
        ]);
        $dataRequest = array("rpta" => "1","msg"=>"agregado correctamente","objeto" => $data);
        return response()->json($dataRequest,201);
    }

    //Actualizar datos de la seccion
    function update(Request $request){
        $data = $request->json()->all();
        $seccionStand = SeccionStand::where('ncodseccionstand',$data['ncodseccionstand'])->first();
        $seccionStand->cseccion = $data['cseccion'];
        $seccionStand->cdescripcion = $data['cdescripcion'];
        $seccionStand->save();
        $dataRequest = array("rpta" => "1","msg"=>"actualizado correctamente","objeto" => $seccionStand);
        return response()->json($dataRequest,200);
    }
}
