<?php


namespace App\Http\Controllers;


use App\SeccionStand;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeccionStandController extends Controller
{

    //! importante recordar:
    //! 0 -> privado
    //! 1 -> publico

    //FUNCIONES PARA TRAER DATOS

    //funcion para devolver todos las secciones
    function index(Request $request)
    {
        $data = SeccionStand::all();
        return response()->json($data, 200);
    }

    //Función para traer de una seccion que creo una persona y estado publico
    function getSeccionesPersonaPublic($codpersona)
    {
        $data = SeccionStand::where('ncodpersona', $codpersona)->orWhere('privacidad', 1)->get();
        return response()->json(Utilitarios::messageOK($data));
    }

    //función para trear las secciones de un evento, dato para combo
    function getDataComboSeccion($codevento){
        $data = DB::select("SELECT ss.ncodseccionstand, ss.cseccion FROM eventoseccion es 
                            INNER JOIN seccionstand ss 
                            ON es.ncodseccionstand = ss.ncodseccionstand
                            WHERE es.ncodevento = $codevento");
        
        return response()->json(Utilitarios::messageOK($data));
    }

    //FUNCIONES CRUD PARA LA TABLA SECCIONES STAND

    //función para crear una nueva seccion
    function create(Request $request)
    {
        //validación de datos
        $this->validate($request, [
            'cseccion' => 'required',
            'cdescripcion' => 'required',
            'ncodpersona' => 'required|exists:persona,ncodpersona',
            'privacidad' => 'required',
        ]);
        $data = $request->json()->all();
        $create = SeccionStand::create([
            'cseccion' => $data['cseccion'],
            'cdescripcion' => $data['cdescripcion'],
            'ncodpersona' => $data['ncodpersona'],
            'privacidad' => $data['privacidad'],
        ]);
        return response()->json(Utilitarios::messageOKC($create), 201);
    }

    //Actualizar datos de la seccion
    function update(Request $request)
    {
        //validación de datos
        $this->validate($request, [
            'ncodseccionstand' => 'required|exists:seccionstand',
            'cseccion' => 'required',
            'cdescripcion' => 'required',
            'privacidad' => 'required',
        ]);

        $data = $request->json()->all();
        $seccionStand = SeccionStand::where('ncodseccionstand', $data['ncodseccionstand'])->first();
        $seccionStand->cseccion = $data['cseccion'];
        $seccionStand->cdescripcion = $data['cdescripcion'];
        $seccionStand->privacidad = $data['privacidad'];
        $seccionStand->save();
        return response()->json(Utilitarios::messageOKU($seccionStand), 200);
    }

    //Cambio de estado de la sección
}
