<?php


namespace App\Http\Controllers;


use App\Evento;
use App\EventoSeccion;
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
        Evento::create([
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
        $dataRequest = array("rpta" => "1","msg"=>"creado correctamente","objeto" => $data);
        return response()->json($dataRequest,201);
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
        $dataRequest = array("rpta" => "1","msg"=>"actualizado correctamente","objeto" => $evento);
        return response()->json($dataRequest,200);
    }

    //función para agregar las secciones a los eventos
    function setSeccionEvento(Request $request){
        $data = $request->json()->all();
        EventoSeccion::create([
            'ncodseccionstand' => $data['ncodseccionstand'],
            'ncodevento' => $data['ncodevento'],
            'ncantidadstand' => $data['ncantidadstand']
        ]);
        $dataRequest = array("rpta" => "1","msg"=>"Seccion agregado correctamente","cantidad" => "one","objeto"=>$data);
        return response()->json($dataRequest,200);
    }

    //Función para agregar muchas secciones, para un evento
    function setMoreSeccionEvento(Request $request){
        $datos = $request->json()->all();
        foreach ($datos as $data){
            EventoSeccion::create([
                'ncodseccionstand' => $data['ncodseccionstand'],
                'ncodevento' => $data['ncodevento'],
                'ncantidadstand' => $data['ncantidadstand']
            ]);
        }
        $dataRequest = array("rpta" => "1","msg"=>"Secciones agregado correctamente", "cantidad" => "much","objetos" => $datos);
        return response()->json($dataRequest,200);
    }

    //TODO * AGREGAR FUNCIÓNES PARA BUSCAR EVENTOS

    function  setEventoSeccion($ncodseccion){
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
    }

    function  setSecciones($codevento){
        $data = DB::select("call sp_getSeccionEvento(?)",[$codevento]);
        return response()->json($data,200);
    }
}
