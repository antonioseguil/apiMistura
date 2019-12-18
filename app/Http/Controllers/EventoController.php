<?php


namespace App\Http\Controllers;


use App\Evento;
use App\EventoSeccion;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    //TODO * FALTA VALIDACIÓN DE DATOS
    //TODO * FALTA VERIFICAR EL CAMPO DE "CESTADO" EN LOS CONTROLADORES
    //TODO * FALTA AGRGAR UN FUNCIÓN QUE REGRESE SOLO LOS EVENTOS ACTIVOS, Y OTRO QUE DEVUELVA TODOS

    //FUNCION QUE DEVUELVEN DATOS

    //Función para regresar todos lo datos de la tabla
    function index(){
        $data = Evento::all();//->where();
        return response()->json($data,200);
    }

    //Función para regresar todos los eventos segun su estado
    function getEventoStatus($status){
        $data = Evento::where('cestado',strtoupper($status))->get();
        return response()->json(Utilitarios::messageOK($data),200);
    }

    //----------------------------------------------------
    //FUNCION PARA CREAR UN NUEVO EVENTO
    function create(Request $request){
        //recuperando datos
        $data = $request->json()->all();
        //validando datos
        $this->validate($request,[
            'ncodpersona' => 'required',
            'cnombreevento' => 'required',
            'cnombredescripcion' => 'required',
            'dfechainicio' => 'required',
            'dfechafinal' => 'required',
            'dhorainicio' => 'required',
            'dhorafinal' => 'required',
            'cdireccion' => 'required',
            'clongitud' => 'required',
            'clatitud' => 'required',

        ]);
        //creación del evento
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

    //función para actualizar un evento
    function update(Request $request){
        //validando datos
        $this->validate($request,[
            'ncodpersona' => 'required',
            'cnombreevento' => 'required',
            'cnombredescripcion' => 'required',
            'dfechainicio' => 'required',
            'dfechafinal' => 'required',
            'dhorainicio' => 'required',
            'dhorafinal' => 'required',
            'cdireccion' => 'required',
            'clongitud' => 'required',
            'clatitud' => 'required',

        ]);
        //recuperando los datos enviados por el http
        $data = $request->json()->all();
        //buscando los datos que se van a modificar
        //el termino "first" indica que solo agarra el primero
        $evento = Evento::where('ncodevento',$data['ncodevento'])->first();
        //actualizando los datos
        $evento->cnombreevento = $data['cnombreevento'];
        $evento->cnombredescripcion = $data['cnombredescripcion'];
        $evento->dfechainicio = $data['dfechainicio'];
        $evento->dfechafinal = $data['dfechafinal'];
        $evento->dhorainicio = $data['dhorainicio'];
        $evento->dhorafinal = $data['dhorafinal'];
        $evento->cdireccion = $data['cdireccion'];
        $evento->clongitud = $data['clongitud'];
        $evento->clatitud = $data['clatitud'];
        //guardando los datos cambiados
        $evento->save();
        //datos que se van a retornar
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
                    "clongitud" => $evento->clongitud,
                    "clatitud" => $evento->clatitud,
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

    //function para ver las seccion que tiene un evento de un usuario  en especifico que creo el evento
    function  getSeccionesPersona($codpersona){
        $data = DB::select("call sp_getSeccionEventoPersona(?)",[$codpersona]);
        return response()->json(Utilitarios::messageOK($data),200);
    }

    //función para cambiar el estado de los eventos
    /*
     * ESTADO DEL EVENTO
     * P = EN PROCESO O CURSO
     * T = TERMINADO
     * E = ESPERA(POR SI AUN NO EMPIEZA EL EVENTO)
     * */
    function eventoTerminar($codevento){
        $evento = Evento::where('ncodevento',$codevento)->first();
        $evento->cestado = 'T';
        $evento->save();
        return response()->json(Utilitarios::messageOK($evento),200);
    }
}
