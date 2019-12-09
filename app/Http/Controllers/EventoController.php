<?php


namespace App\Http\Controllers;


use App\Evento;
use App\EventoSeccion;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    //TODO * FALTA VERIFICAR EL CAMPO DE "CESTADO" EN LOS CONTROLADORES

    //función para regresar todos lo datos de la tabla
    function index(){
        $data = Evento::all();
        return response()->json($data,200);
    }

    //FUNCION PARA CREAR UN NUEVO EVENTO
    function create(Request $request){
        $data = $request->json()->all();
        $create = Evento::create([
            'ncodpersona' => $data['ncodpersona'],
            'cnombreevento' => $data['cnombreevento'],
            'cnombredescripcion' => $data['cnombredescripcion'],
            'dfechainicio' => $data['dfechainicio'],
            'dfechafinal' => $data['dfechafinal'],
            'dhorainicio' => $data['dhorainicio'],
            'dhorafinal' => $data['dhorafinal'],
            'cdireccion' => $data['cdireccion'],
            'clongitud' => $data['clongitud'],
            'clatitud' => $data['clatitud']
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    function update(Request $request){
        $data = $request->json()->all();
        $evento = Evento::where('ncodevento',$data['ncodevento'])->first();
        $evento->cnombreevento = $data['cnombreevento'];
        $evento->cnombredescripcion = $data['cnombredescripcion'];
        $evento->dfechainicio = $data['dfechainicio'];
        $evento->dfechafinal = $data['dfechafinal'];
        $evento->dhorainicio = $data['dhorainicio'];
        $evento->dhorafinal = $data['dhorafinal'];
        $evento->cdireccion = $data['cdireccion'];
        $evento->clongitud = $data['clongitud'];
        $evento->clatitud = $data['clatitud'];
        $evento->save();
        return response()->json(Utilitarios::messageOKU($evento),200);
    }

    //función para agregar las secciones a los eventos
    function setSeccionEvento(Request $request){
        $data = $request->json()->all();
        $create = EventoSeccion::create([
            'ncodseccionstand' => $data['ncodseccionstand'],
            'ncodevento' => $data['ncodevento'],
            'ncantidadstand' => $data['ncantidadstand']
        ]);
        return response()->json(Utilitarios::messageMoreData($create),200);
    }

    //Función para agregar muchas secciones, para un evento
    function setMoreSeccionEvento(Request $request){
        $datos = $request->json()->all();
        //variable que contendra lo creado
        $returnData = array();
        foreach ($datos as $data){
            $create = EventoSeccion::create([
                'ncodseccionstand' => $data['ncodseccionstand'],
                'ncodevento' => $data['ncodevento'],
                'ncantidadstand' => $data['ncantidadstand']
            ]);
            array_push($returnData,$create);
        }
        return response()->json(Utilitarios::messageMoreData($returnData,count($returnData)),200);
    }

    //TODO * AGREGAR FUNCIÓNES PARA BUSCAR EVENTOS
    //funcion para buscar todos los eventos que contegan una sección, ademas de traer el plato mas barato.

    function  setEventoSeccion($ncodseccion){
            //creacion de variable que contendra los datos
            $returnData = array();
            //creaacion de lista de codigo
            $listaCodigo = array();
            //lista de plato
            $prueba = null;
            //recuperando lista de evento
            $dataEvento = DB::select("call sp_getEventoSeccion(?)",[$ncodseccion]);

            //recuperamos los codigos de evento
            foreach($dataEvento as $codigo){
                array_push($listaCodigo,$codigo->ncodevento);
            }

            foreach($dataEvento as $evento){

                $prueba = array("ncodevento" => $evento->ncodevento,
                    "cnombreevento" => $evento->cnombreevento,
                    "cnombredescripcion" => $evento->cnombredescripcion,
                    "dfechainicio" => $evento->dfechainicio,
                    "dfechafinal" => $evento->dfechafinal,
                    "dhorainicio" => $evento->dhorainicio,
                    "dhorafinal" => $evento->dhorafinal,
                    "cdireccion" => $evento->cdireccion,
                    "objPlato" => DB::select("call sp_getStandPrecioM(?,?)",[$evento->ncodevento,$ncodseccion]));
                array_push($returnData,$prueba);
            }
            return response()->json($returnData,200);
        }


    //funcion para ver las secciones que tiene un evento
    function  setSecciones($codevento){
        $data = DB::select("call sp_getSeccionEvento(?)",[$codevento]);
        return response()->json($data,200);
    }
}
