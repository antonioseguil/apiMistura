<?php


namespace App\Http\Controllers;


use App\SeccionStand;
use Illuminate\Http\Request;

class SeccionStandController extends Controller
{
    function index(Request $request){
        if($request->isJson()){
            $data = SeccionStand::all();
            return response()->json($data,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function create(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            SeccionStand::create([
                'cnombredescripcion' => $data['cnombredescripcion'],
                'ncantidadstand' => $data['ncantidadstand'],
                'cestado' => $data['cestado']
            ]);
            return response()->json($data,201);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }

    function update(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            $seccionStand = SeccionStand::where('ncodseccionstand',$data['ncodseccionstand'])->first();
            $seccionStand->cnombredescripcion = $data['cnombredescripcion'];
            $seccionStand->ncantidadstand = $data['ncantidadstand'];
            $seccionStand->cestado = $data['cestado'];
            $seccionStand->save();
            return response()->json($seccionStand,200);
        }
        return response()->json(['error' => 'no autorizado'],402);
    }
}
