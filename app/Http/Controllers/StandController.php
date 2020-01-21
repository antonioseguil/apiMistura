<?php


namespace App\Http\Controllers;



use App\Stand;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;

class StandController extends Controller
{
    //FUNCIONES PARA DEVOLVER DATOS
    //función que devuelve todos los datos del stand
    function index()
    {
        $data = Stand::all();
        return response()->json(Utilitarios::messageOK($data), 200);
    }

    //Función para regresar todos los STAND segun su estado
    function getStandStatus($status)
    {
        $data = Stand::where('cestado', strtoupper($status))->get();
        return response()->json(Utilitarios::messageOK($data), 200);
    }

    //función que devuelve todos los datos del stand
    function getStandNegocio($codnegocio)
    {
        $data = Stand::where('ncodnegocio', $codnegocio)->get();
        return response()->json(Utilitarios::messageOK($data), 200);
    }

    //Función para delvolver datos para combo
    function getStandCombo($codevento, $codseccion)
    {
        $data = DB::select("SELECT s.ncodstand, n.ncodnegocio, s.cnumerosstand, n.crazonsocial FROM stand s
                            INNER JOIN negocio n 
                            ON s.ncodnegocio = n.ncodnegocio
                            WHERE ncodevento=$codevento AND ncodseccionstand = $codseccion");
        return response()->json(Utilitarios::messageOK($data));
    }

    //Función para delvolver datos para la distribucioón de stand
    function getStandEventoSeccion($codevento, $codseccion)
    {
        $cantidaEspacios = DB::select("SELECT ncantidadstand FROM eventoseccion WHERE ncodevento = $codevento AND ncodseccionstand = $codseccion");
        $objStand = DB::select("call sp_getstandsSeccionEvento(?,?)", [$codevento, $codseccion]);
        $data = array();
        foreach ($objStand as $stand) {
            $d = array(
                "ncodstand" => $stand->ncodstand,
                "ncodevento" => $stand->ncodevento,
                "ncodseccionstand" => $stand->ncodseccionstand,
                "ncodnegocio" => $stand->ncodnegocio,
                "cnumerosstand" => $stand->cnumerosstand,
                "cestado" => $stand->cestado,
                "objnegocio" => DB::select("SELECT ncodnegocio,crazonsocial FROM negocio WHERE ncodnegocio = $stand->ncodnegocio ")
            );
            array_push($data, $d);
        }
        $dataReturn = array("cantidadstand" => $cantidaEspacios[0]->ncantidadstand, "stands" => $data);
        return response()->json(Utilitarios::messageOK($dataReturn));
    }

    //Función de busqueda de stand 

    //-----------------------------------------------------------

    //función para agregar un nuevo stand, recibe dato json
    function create(Request $request)
    {
        //recogiendo la data
        $data = $request->json()->all();
        //validando datos
        $this->validate($request, [
            'ncodevento' => 'required|exists:evento|integer',
            'ncodnegocio' => 'required|exists:negocio|integer',
            'ncodseccionstand' => 'required:exists:seccionstand|integer',
            'cnumerosstand' => 'required',
            'clongitud' => 'required',
            'clatitud' => 'required',
        ]);

        //creano el stand nuevo
        $create = Stand::create([
            'ncodevento' => $data['ncodevento'],
            'ncodnegocio' => $data['ncodnegocio'],
            'ncodseccionstand' => $data['ncodseccionstand'],
            'cnumerosstand' => $data['cnumerosstand'],
            'clongitud' => $data['clongitud'],
            'clatitud' => $data['clatitud']
        ]);
        return response()->json(Utilitarios::messageOKC($create), 201);
    }

    //función para actualizar
    function update(Request $request)
    {
        $data = $request->json()->all();
        $this->validate($request, [
            'ncodstand' => 'required|exists:stand',
            'ncodnegocio' => 'required|exists:negocio'
        ]);
        $stand = Stand::where('ncodstand', $data['ncodstand'])->first();
        $stand->ncodnegocio = $data['ncodnegocio'];
        $stand->cestado =  'N';
        $stand->save();
        return response()->json(Utilitarios::messageOKU($stand), 200);
    }

    //funcion para cambiar de estado al stand
    /*
     * ESTADOS DEL STAND
     * D = DISPONIBLE
     * N = NO DISPONIBLE
     * */
    function standDelete($codstand)
    {
        $stand = Stand::where('ncodstand', $codstand)->first();
        $stand->cestado = 'D';
        $stand->save();
        return response()->json(Utilitarios::messageOK($stand), 200);
    }

    // ==============================================
    // ======================REPORTES================

    function reporteStand($codevento,$codseccion,$codstand){
        $data = DB::select("call reporteStand(?,?,?)",[$codevento,$codseccion,$codstand]);
        return \response()->json(Utilitarios::messageOK($data),200);
    }

}
