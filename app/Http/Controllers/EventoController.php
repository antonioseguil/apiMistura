<?php


namespace App\Http\Controllers;


use App\Evento;
use App\EventoSeccion;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    //FUNCION QUE DEVUELVEN DATOS

    //Función para regresar todos lo datos de la tabla
    function index()
    {
        $data = Evento::all();
        return response()->json(Utilitarios::messageOK($data), 200);
    }

    //Función para retornar los dato para un combo
    function getEventoPersona($codpersona){
        $data = Evento::where('ncodpersona',$codpersona);
        return response()->json(Utilitarios::messageOK($data));
    }

    //Función para retornar los dato para un combo
    function getEventoPersonaCombo($codpersona){
        $sql = "SELECT ncodevento,cnombreevento FROM evento WHERE ncodpersona = $codpersona";
        $data = DB::select($sql);
        return response()->json(Utilitarios::messageOK($data));
    }

    //Función para regresar todos los eventos segun su estado
    function getEventoStatus($status)
    {
        $data = Evento::where('cestado', strtoupper($status))->get();
        return response()->json(Utilitarios::messageOK($data), 200);
    }

    //----------------------------------------------------
    //FUNCION PARA CREAR UN NUEVO EVENTO
    function create(Request $request)
    {
        //recuperando datos
        $data = $request->json()->all();
        //validando datos
        $this->validate($request, [
            'ncodpersona' => 'required|exists:persona,ncodpersona|integer',
            'cnombreevento' => 'required',
            'cnombredescripcion' => 'required',
            'dfechainicio' => 'required|date|after:tomorrow',
            'dfechafinal' => 'required|date|after:dfechainicio',
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
        return response()->json(Utilitarios::messageOKC($create), 201);
    }

    //función para actualizar un evento
    function update(Request $request)
    {
        //validando datos
        $this->validate($request, [
            'ncodevento' => 'required|exists:evento,ncodevento|integer',
            'cnombreevento' => 'required',
            'cnombredescripcion' => 'required',
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
        $evento = Evento::where('ncodevento', $data['ncodevento'])->first();
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
        return response()->json(Utilitarios::messageOKU($evento), 200);
    }

    /*
     * FUNCIONES PARA EL DETALLE DE SECCION Y EVENTO
     */

    //función para agregar las secciones a los eventos
    function setSeccionEvento(Request $request)
    {
        //validación de datos
        $this->validate($request, [
            'ncodseccionstand' => 'required|exists:seccionstand|integer',
            'ncodevento' => 'required|exists:evento|integer',
            'ncantidadstand' => 'required|integer'
        ]);
        //capturar todos los datos
        $data = $request->json()->all();
        $create = EventoSeccion::create([
            'ncodseccionstand' => $data['ncodseccionstand'],
            'ncodevento' => $data['ncodevento'],
            'ncantidadstand' => $data['ncantidadstand']
        ]);
        return response()->json(Utilitarios::messageMoreData($create), 200);
    }

    //Función para agregar muchas secciones, para un evento
    function setMoreSeccionEvento(Request $request)
    {
        $datos = $request->json()->all();
        //variable que contendra lo creado
        $returnData = array();
        foreach ($datos as $data) {
            $create = EventoSeccion::create([
                'ncodseccionstand' => $data['ncodseccionstand'],
                'ncodevento' => $data['ncodevento'],
                'ncantidadstand' => $data['ncantidadstand']
            ]);
            array_push($returnData, $create);
        }
        return response()->json(Utilitarios::messageMoreData($returnData, count($returnData)), 200);
    }

    //Función para actualizar la cantidad de stand de una seccion de un evento
    function updateCantidadStand(Request $request)
    {
        //recogiendo los datos
        $datos = $request->json()->all();
        //validación de datos
        $this->validate($request, [
            'ncodevento' => 'required|exists:eventoseccion|integer',
            'ncodseccionstand' => 'required|exists:eventoseccion|integer',
            'ncantidadstand' => 'required|integer'
        ]);
        //buscamos el detalle
        $detalle = EventoSeccion::where('ncodevento', $datos['ncodevento'])->where('ncodseccionstand', $datos['ncodseccionstand'])->first();
        //actualizamos los nuevos cambios
        $detalle->ncantidadstand = $datos['ncantidadstand'];
        $detalle->save();

        return response()->json(Utilitarios::messageOKU($detalle));
    }

    /*
     * FUNCIONES PARA LA BUSQUEDA DE EVENTOS
     */

    //funcion para buscar todos los eventos que contegan una sección, ademas de traer el plato mas barato.
    function  setEventoSeccion($ncodseccion)
    {
        //creacion de variable que contendra los datos
        $returnData = array();
        //creaacion de lista de codigo
        $listaCodigo = array();
        //lista de plato
        $prueba = null;
        //recuperando lista de evento
        $dataEvento = DB::select("call sp_getEventoSeccion(?)", [$ncodseccion]);

        //recuperamos los codigos de evento
        foreach ($dataEvento as $codigo) {
            array_push($listaCodigo, $codigo->ncodevento);
        }

        foreach ($dataEvento as $evento) {

            $prueba = array(
                "ncodevento" => $evento->ncodevento,
                "cnombreevento" => $evento->cnombreevento,
                "cnombredescripcion" => $evento->cnombredescripcion,
                "dfechainicio" => $evento->dfechainicio,
                "dfechafinal" => $evento->dfechafinal,
                "dhorainicio" => $evento->dhorainicio,
                "dhorafinal" => $evento->dhorafinal,
                "cdireccion" => $evento->cdireccion,
                "clongitud" => $evento->clongitud,
                "clatitud" => $evento->clatitud,
                "objPlato" => DB::select("call sp_getStandPrecioM(?,?)", [$evento->ncodevento, $ncodseccion])
            );
            $precio = $prueba['objPlato'][0]->precio != null;
            $precio ? array_push($returnData, $prueba) : "error";
        }
        return response()->json($returnData, 200);
    }


    //funcion para ver las secciones que tiene un evento
    function  setSecciones($codevento)
    {
        $data = DB::select("call sp_getSeccionEvento(?)", [$codevento]);
        return response()->json($data, 200);
    }

    //function para ver las seccion que tiene un evento de un usuario  en especifico que creo el evento
    function  getSeccionesPersona($codpersona)
    {
        $data = DB::select("call sp_getSeccionEventoPersona(?)", [$codpersona]);
        return response()->json(Utilitarios::messageOK($data), 200);
    }

    //función para cambiar el estado de los eventos
    /*
     * ESTADO DEL EVENTO
     * A = ACTIVO
     * D = DESACTIVADO
     * I = INICIADO
     * F = FINALIZADO
     * */
    function eventoTerminar($codevento)
    {
        $evento = Evento::where('ncodevento', $codevento)->first();
        $evento->cestado = 'T';
        $evento->save();
        return response()->json(Utilitarios::messageOK($evento), 200);
    }
}
