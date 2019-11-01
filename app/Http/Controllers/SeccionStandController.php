<?php


namespace App\Http\Controllers;


use App\SeccionStand;
use Illuminate\Http\Request;

class SeccionStandController extends Controller
{
    function index(Request $request){
        $data = SeccionStand::all();
        return response()->json($data,200);
    }

    function create(Request $request){
        $data = $request->json()->all();
        SeccionStand::create([
            'cnombredescripcion' => $data['cnombredescripcion'],
            'ncantidadstand' => $data['ncantidadstand'],
            'cestado' => $data['cestado']
        ]);
        return response()->json($data,201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $seccionStand = SeccionStand::where('ncodseccionstand',$data['ncodseccionstand'])->first();
        $seccionStand->cnombredescripcion = $data['cnombredescripcion'];
        $seccionStand->ncantidadstand = $data['ncantidadstand'];
        $seccionStand->cestado = $data['cestado'];
        $seccionStand->save();
        return response()->json($seccionStand,200);
    }
}
