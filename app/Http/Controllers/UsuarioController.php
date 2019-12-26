<?php


namespace App\Http\Controllers;


use App\Evento;
use App\User;
use App\Utilitarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsuarioController extends Controller
{

    //FUNCION PARA TRAER DATOS DE LOS USUARIOS
    //función para devolver los usuarios
    function index(){
        $data = User::all();
        return response()->json($data,200);
    }

    //FUNCTION PARA VER LA LISTA DE PERSONAS SEGUN TIPO Y ESTADO

    function searchUsuario($estado,$tipousuario){
        $data = DB::select('call sp_getSearchPersona(?,?)',[$estado,$tipousuario]);
        return response()->json(Utilitarios::messageOK($data),200);
    }

    //----------------------------------

    //Función para crear una nueva persona (usuario)
    function create(Request $request){
        //recogiendo los datos enviados por el request
        $data = $request->json()->all();
        //validando datos
        $this->validate($request,[
            'cnombre' => 'required|string',
            'capellidopaterno' => 'required|string',
            'capellidomaterno' => 'required|string',
            'cdni' => 'required|unique:persona,cdni',
            'cemail' => 'required|unique:persona,cemail',
            'cimei_phone' => 'nullable',
            'cusuario' => 'required|unique:persona,cusuario',
            'cpassword' => 'required',

        ]);
        //verificando la existencia de datos
        if(!$request->exists('ncodtipousuario')){
            //si el dato verificado es nulo, se pondra por defecto = CLIENTE = 1
                User::create([
                'cnombre' => $data['cnombre'],
                'capellidopaterno' => $data['capellidopaterno'],
                'capellidomaterno' => $data['capellidomaterno'],
                'cdni' => $data['cdni'],
                'cemail' => $data['cemail'],
                'api_token' => Str::random(60),
                'imei_phone' => $data['cimei_phone'],
                'cusuario' => $data['cusuario'],
                'cpassword' => Hash::make($data['cpassword']),
            ]);
        }else{
            //caso contrario agregara el tipo que se indique
                User::create([
                'cnombre' => $data['cnombre'],
                'capellidopaterno' => $data['capellidopaterno'],
                'capellidomaterno' => $data['capellidomaterno'],
                'cdni' => $data['cdni'],
                'cemail' => $data['cemail'],
                'api_token' => Str::random(60),
                'imei_phone' => $data['cimei_phone'],
                'cusuario' => $data['cusuario'],
                'cpassword' => Hash::make($data['cpassword']),
                'ncodtipousuario' => $data['ncodtipousuario'],
            ]);
        }
        $registrado= User::where('cemail',$data['cemail'])->first();
        return response()->json(Utilitarios::messageOKC($registrado),201);
    }

    //función para actualizar la persona
    function update(Request $request){
        $data = $request->json()->all();
        //validando datos
        $this->validate($request,[
            'ncodpersona' => 'required|exists:persona,ncodpersona',
            'cnombre' => 'required|string',
            'capellidopaterno' => 'required|string',
            'capellidomaterno' => 'required|string',
            'cdni' => 'required',
        ]);
        //dato que se usa para buscar al usuario
        $usuario = User::where('ncodpersona',$data['ncodpersona'])->first();
        //datos a modificar
        $usuario->cnombre = $data['cnombre'];
        $usuario->capellidopaterno = $data['capellidopaterno'];
        $usuario->capellidomaterno = $data['capellidomaterno'];
        //$usuario->ckeypersona = $data['ckeypersona']; TODO * SE CREARA UN PATH EXCLUSVIO PARA ELLO
        $usuario->cdni = $data['cdni'];
        $usuario->save();
        return response()->json(Utilitarios::messageOKU($usuario),200);
    }


    // Función para validar los datos de un usuario al tratar de loguearse
    function getLoginUser(Request $request){
        //recuperando los datos enviados
        $data = $request->json()->all();
        //validando datos
        $this->validate($request,[
            'cusuario' => 'required|exists:persona,cusuario',
            'cpassword' => 'required'
        ]);
        //buscando persona por su usuario, el usuario es unico
        $user = User::where('cusuario',$data['cusuario'])->first();
        //comprobando si existe, y si existe se compara su password
        if($user && Hash::check($data['cpassword'],$user->cpassword) && strtoupper($user->cestado) == 'A'){
            //RECUPERANDO PERMISOS
            //buscando permisos del usuario
            $tipoUsuario = $user->ncodtipousuario;
            //llamando al store procedure
            $listaPermiso = DB::select('call sp_getPermisosUser(?)',[$tipoUsuario]);

            //AGREGANDO LOS PERMISOS
            //definimos un array donde se guardara los permisos
            $permisos = array();
            //recorremos los datos traidos anteriormente
            foreach ($listaPermiso as $key =>$value){
                //en los datos cada espacio es otro arreglo, asi que se recorre una segunda vez
                foreach ($value as $valor){
                    //finalmente se agrega el valor
                    array_push($permisos, $valor);
                }
            }
            //ENVIANDO RESPUESTA
            //datos de respuesta
            $responseData = array("rpta" => 1,"datos" => $user,"permiso" => $permisos);
            //enviando respuesta
            return response()->json($responseData,200);
        }else{
            //agregando respuesta de error
            $responseData = array("rpta" => 0,"error" => "not content","message" => "revise su usuario y contraseña",
                "datos" => []);
            return response()->json($responseData,406);
        }
    }

    //function para ver los eventos creados por una persona
    function getPersonaEvento($codpersona){
        $data = Evento::where('ncodpersona',$codpersona)->get();
        return response()->json(Utilitarios::messageOK($data),200);
    }

    //functión para buscar los datos de una persona por codigo
    function getPersona($codpersona){
        $data = User::where('ncodpersona',$codpersona)->get();
        return response()->json(Utilitarios::messageOK($data),200);
    }

    //funcion para cambiar de estado a la persona
    /*
     * ESTADOS DEL STAND
     * A = ACTIVO, QUE ESTA FUNCIONANDO
     * D = DESABILITADO
     * */
    function personaDelete($codpersona){
        $persona = User::where('ncodpersona',$codpersona)->first();
        $persona->cestado = 'D';
        $persona->save();
        return response()->json(Utilitarios::messageOK($persona),200);
    }

    //TODO * CREAR FUNCIÓN PARA ACTUALIZAR LA KEY PERSONA Y BUSCAR UNA KEY PERSONA
}
