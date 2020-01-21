<?php


namespace App\Http\Controllers;


use App\Negocio;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NegocioController extends Controller
{

    //TODO preguntar sobre la privacidad en negocio, funcionalidad

    //FUNCIONES QUE DEVUELVEN DATOS

    //! importante recordar:
    //! 0 -> privado
    //! 1 -> publico

    //función para devolver todos los datos de la tabla
    function index()
    {
        $data = Negocio::all();
        return response()->json(Utilitarios::messageOK($data), 200);
    }

    //función para devolver todos los datos que se ha registrado una persona
    function getNegocioPersonaPublic($codpersona)
    {
        $data = Negocio::where('ncodpersona', $codpersona)->orWhere('privacidad', '1')->get();
        return response()->json(Utilitarios::messageOK($data), 200);
    }

    //función para devolver todos los datos que se ha registrado una persona
    function getNegocioPersonaPublicCombo($codpersona)
    {
        $sql = "SELECT ncodnegocio, crazonsocial FROM negocio WHERE ncodpersona = $codpersona OR privacidad =1 ";
        $data = DB::select($sql);
        return response()->json(Utilitarios::messageOK($data), 200);
    }

    //Función para regresar todos los NEGOCIOS segun su estado
    function getNegocioStatus($status)
    {
        $data = Negocio::where('cestado', strtoupper($status))->get();
        return response()->json(Utilitarios::messageOK($data), 200);
    }

    //------------------------------------------------------------

    //FUNCIONES CRUD PARA LA TABLA NEGOCIO

    //Función que crea un nuevo negocio
    function create(Request $request)
    {
        //se recuperan los datos
        $data = $request->json()->all();
        //validamos los datos
        $this->validate($request, [
            'crazonsocial' => 'required',
            'cnombredescripcion' => 'required',
            'cdireccion' => 'required',
            'cruc' => 'required|unique:negocio',
            'ncodpersona' => 'required|exists:persona,ncodpersona',
            'privacidad' => 'required',
        ]);
        //creamos el negocio
        $create = Negocio::create([
            'crazonsocial' => $data['crazonsocial'],
            'cnombredescripcion' => $data['cnombredescripcion'],
            'cdireccion' => $data['cdireccion'],
            'ncodpersona' => $data['ncodpersona'],
            'privacidad' => $data['privacidad'],
            'cruc' => $data['cruc'],
        ]);

        return response()->json(Utilitarios::messageOKC($create), 201);
    }

    //Función actualizar un negocio
    function update(Request $request)
    {
        //obtenemos los datoss
        $data = $request->json()->all();
        //validamos datos
        $this->validate($request, [
            'ncodnegocio' => 'required|exists:negocio',
            'crazonsocial' => 'required',
            'cnombredescripcion' => 'required',
            'cdireccion' => 'required',
            'ncodpersona' => 'required|exists:persona,ncodpersona',
            'privacidad' => 'required',
            'cruc' => 'required|max:11'
        ]);

        //actualizando los datos
        $negocio = Negocio::where('ncodnegocio', $data['ncodnegocio'])->first();
        $negocio->crazonsocial = $data['crazonsocial'];
        $negocio->cnombredescripcion = $data['cnombredescripcion'];
        $negocio->cdireccion = $data['cdireccion'];
        $negocio->ncodpersona = $data['ncodpersona'];
        $negocio->privacidad = $data['privacidad'];
        $negocio->cruc = $data['cruc'];
        $negocio->save();
        return response()->json(Utilitarios::messageOKU($negocio), 200);
    }
    // -- la función para ver las usuarios que tiene agregado un negocio

    function getUsuarioNegocio($codpersona)
    {
        $user = DB::select("call sp_getUsuarioNegocio(?)",[$codpersona]);
        return response()->json(Utilitarios::messageOK($user), 200);
    }


    //función para cambiar el estado del negocio
    /*
     * ESTADO DEL EVENTO
     * A = ACTIVO, QUE ESTA FUNCIONANDO
     * D = DESACTIVADO
     * */
    function negocioDelete($codnegocio)
    {
        $negocio = Negocio::where('ncodnegocio', $codnegocio)->first();
        $negocio->cestado = 'D';
        $negocio->save();
        return response()->json(Utilitarios::messageOK($negocio), 200);
    }
}
