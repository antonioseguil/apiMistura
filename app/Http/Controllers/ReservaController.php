<?php


namespace App\Http\Controllers;


use App\Reserva;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    function index(){
        $data = Reserva::all();
        return response()->json($data,200);
    }

    //funcion para crear una reserva
    function create(Request $request){
        //validación de datos
        $this->validate($request,[
            'ncodpersona' => 'required|exists:persona',
        ]);
        $data = $request->json()->all();
        //INSTANCIA PARA LA FECHA
        $time = new \DateTime();
        $create = Reserva::create([
            'ncodpersona' => $data['ncodpersona'],
            'ncantidadtotal' => '0',
            'dfechareserva' => $time->format('Y-m-d')
        ]);
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    //función para actualizar la cantidad total
    function update(Request $request){
        //validación de datos
        $this->validate($request,[
            'ncodreserva' => 'required|exists:reserva',
            'ncantidadtotal' => 'required',
        ]);
        $data = $request->json()->all();
        $reserva = Reserva::where('ncodreserva',$data['ncodreserva'])->first();
        $reserva->ncantidadtotal = $data['ncantidadtotal'];
        $reserva->save();
        return response()->json(Utilitarios::messageOKU($reserva),200);
    }

    //funcion para cambiar de estado de la reserva
    /*
     * ESTADOS DE LA RESERVA
     * R = RESERVADO
     * E = ENTREGADO
     * C = CANCELADO
     * */
    function reservaStatus($codreserva,$estatus){
        $reserva = Reserva::where('ncodreserva',$codreserva)->first();
        $reserva->cestado = strtoupper($estatus);
        return response()->json(Utilitarios::messageOK($reserva),200);
    }

    // -------------------------------------------------------------------------------
    // -------------------------------------------------------------------------------

    //función para ver las reservas de un cliente
    function reservasCliente($codcliente){
        //recogemos los datos de la consulta
        $reservas = DB::select('call sp_getReservaCliente(?)', [$codcliente]);
        //array donde vamos a guardar la data
        $data = array();
        //recorremos las reservas
        foreach ($reservas as $reserva) {
            $d = array(
                "ncodreserva" => "000". $reserva->ncodreserva,
                "ncodpersona" => $reserva->ncodpersona,
                "ncantidadtotal" => $reserva->ncantidadtotal,
                "cestado" => $reserva->cestado,
                "dfechareserva" => $reserva->dfechareserva,
                "cnombreevento" => $reserva->cnombreevento,
                "cdireccion" => $reserva->cdireccion,
                "clatitud" => $reserva->clatitud,
                "clongitud" => $reserva->clongitud,
                "cnombreplato" => $reserva->cnombreplato,
                "detalle" => DB::select('call sp_getDetReserva(?)', [$reserva->ncodreserva])
            );
            array_push($data,$d);
        }
        return response()->json($data,200);
    }

    //función para la saber las reservas por codigo cliente y valor 
    function reservasClienteFiltrado($codcliente,$valor){
        //recogemos los datos de la consulta
        $reservas = DB::select('call sp_getReservaClienteFiltrado(?,?)', [$codcliente,$valor]);
        //array donde vamos a guardar la data
        $data = array();
        //recorremos las reservas
        foreach ($reservas as $reserva) {
            $d = array(
                "ncodreserva" => "000". $reserva->ncodreserva,
                "ncodpersona" => $reserva->ncodpersona,
                "ncantidadtotal" => $reserva->ncantidadtotal,
                "cestado" => $reserva->cestado,
                "dfechareserva" => $reserva->dfechareserva,
                "cnombreevento" => $reserva->cnombreevento,
                "cdireccion" => $reserva->cdireccion,
                "clatitud" => $reserva->clatitud,
                "clongitud" => $reserva->clongitud,
                "cnombreplato" => $reserva->cnombreplato,
                "detalle" => DB::select('call sp_getDetReserva(?)', [$reserva->ncodreserva])
            );
            array_push($data,$d);
        }
        return response()->json($data,200);
    }


    //función para la saber las reservas exitosas filtradas por fecha y evento
    function reservasClienteFechaEvento($codcliente,$fecha,$evento){
        //recogemos los datos de la consulta
        $reservas = DB::select('call sp_getReservaClienteFechaEvento(?,?,?)', [$codcliente,$fecha,$evento]);
        //array donde vamos a guardar la data
        $data = array();
        //recorremos las reservas
        foreach ($reservas as $reserva) {
            $d = array(
                "ncodreserva" => "000". $reserva->ncodreserva,
                "ncodpersona" => $reserva->ncodpersona,
                "ncantidadtotal" => $reserva->ncantidadtotal,
                "cestado" => $reserva->cestado,
                "dfechareserva" => $reserva->dfechareserva,
                "cnombreevento" => $reserva->cnombreevento,
                "cdireccion" => $reserva->cdireccion,
                "clatitud" => $reserva->clatitud,
                "clongitud" => $reserva->clongitud,
                "cnombreplato" => $reserva->cnombreplato,
                "detalle" => DB::select('call sp_getDetReserva(?)', [$reserva->ncodreserva])
            );
            array_push($data,$d);
        }
        return response()->json($data,200);
    }
}
