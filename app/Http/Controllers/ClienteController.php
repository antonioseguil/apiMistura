<?php


namespace App\Http\Controllers;


use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClienteController extends Controller
{

    function index(Request $request){
        $data = Cliente::all();
        return response()->json($data,200);
    }

    //funcion para la creación o registro de nuevos clientes
    function create(Request $request){
        //TOOD * agregar al cuerpo del JSON rpta....
        $data = $request->json()->all();

        //creacion de variable que contien el api_token del nuevo cliente, esto para devolverlo
        $api_token = Str::random(60);
        Cliente::create([
            'cusuario' => $data['cusuario'],
            'cpassword' => Hash::make($data['cpassword']),
            'cnombre' => $data['cnombre'],
            'capellidopaterno' => $data['capellidopaterno'],
            'capellidomaterno' => $data['capellidomaterno'],
            'cdni' => $data['cdni'],
            'ccorreo' => $data['ccorreo'],
            'api_token' => $api_token
        ]);
        return response()->json(['rpta' => '1','api_token' => $api_token],201);
    }

    //Actualización de nuevo cliente
    function update(Request $request){
        //recuperación de datos enviados por la petición
        $data = $request->json()->all();
        //busqueda del cliente
        $cliente = Cliente::where('ncodcliente',$data['ncodcliente'])->first();
        //modificando datos
        $cliente->cnombre = $data['cnombre'];
        $cliente->capellidopaterno = $data['capellidopaterno'];
        $cliente->capellidomaterno = $data['capellidomaterno'];
        //guardando datos
        $cliente->save();
        //devolviendo datos
        return response()->json(['rpta'=>'1','cliente' => $cliente],202);
    }

    //TODO * función para loguear al sistema, retorna la lista de reserva que el usuario haya hecho.
    function getToken(Request $request){
         try{
            //TODO * Agregar la busqueda de reserva del cliente, crear SP para busqueda de reserva por cliente

            //creando array de respuesta
            $rpta = new  array('2');
            //recuperando datos enviados en el pedido
            $data = $request->json()->all();
            $user = Cliente::where('cusuario',$data['cusuario'])->first();
            if($user && Hash::check($data['cpassword'],$user->cpassword)){
                //cambiando el valor de la respuesta
                $rpta[0] = '1';
                //agregando cliente agregado
                //crenado array para devolver
                $rdata = array('rpta' => $rpta[0],'cliente' => $user);
                //TODO * agregado de la busqueda de reserva del cliente, sp
                //-----------------------
                //devolviendo datos
                return response()->json($rdata,202);
            }
            }catch (ModelNotFoundException $exception){
                return response()->json(['rpta' =>$rpta, 'error'=>'no content'],406);
            }
    }

    //funcion para buscar cliente por id, enviado por el path de la url
    function searchCliente($idCliente){
        //busqueda de cliente por idcliente
        $cliente = Cliente::where('ncodcliente',$idCliente)->first();
        //devolviendo datos
        return response()->json(['rpta' => '1','cliente' => $cliente]);

    }
}
