<?php


namespace App\Http\Controllers;


use App\SeccionStand;
use App\Utilitarios;
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
        //validación de datos
        $this->validate($request,[
            'cseccion' => 'required',
            'cdescripcion' => 'required',
        ]);
        $data = $request->json()->all();
        $create = SeccionStand::create([
            'cseccion' => $data['cseccion'],
            'cdescripcion' => $data['cdescripcion']
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    //Actualizar datos de la seccion
    function update(Request $request){
        //validación de datos
        $this->validate($request,[
            'ncodseccionstand' => 'required',
            'cseccion' => 'required',
            'cdescripcion' => 'required',
        ]);
        $data = $request->json()->all();
        $seccionStand = SeccionStand::where('ncodseccionstand',$data['ncodseccionstand'])->first();
        $seccionStand->cseccion = $data['cseccion'];
        $seccionStand->cdescripcion = $data['cdescripcion'];
        $seccionStand->save();
        return response()->json(Utilitarios::messageOKU($seccionStand),200);
    }
}
