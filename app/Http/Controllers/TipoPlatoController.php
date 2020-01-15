<?php


namespace App\Http\Controllers;


use App\TipoPlato;
use App\Utilitarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoPlatoController extends Controller
{

     //! importante recordar:
     //! 0 -> privado
     //! 1 -> publico

     // ==================================================

    //FUNCIONES PARA DEVOLVER DATOS 

    //función para delvolver datos
    function index(Request $request){
        $data = TipoPlato::all();
        return response()->json($data,200);
    }
    
    //funcion para devolver los tipo de platos, de la persona que ha creado y los que estan en estado publico
    function getPlatoPersonaPublic($codpersona){
        $data = TipoPlato::where('ncodpersona',$codpersona)->orWhere('privacidad','1')->get();
        return response()->json(Utilitarios::messageOK($data));
    }

    //funcion para devolver los tipo de platos, de la persona que ha creado y los que estan en estado publico
    function getPlatoPersonaPublicCombo($codpersona){
        $sql = "SELECT ncodtipoplato,cnombretipoplato FROM tipoplato WHERE ncodpersona=$codpersona OR privacidad = 1";
        $data = DB::select($sql);
        return response()->json(Utilitarios::messageOK($data));
    }

    // FUNCIONES CRUD DE LA TABLA TIPO PLATO
    function create(Request $request){
        //validación de datos
        $validate = $this->validate($request,[
            'cnombretipoplato' => 'required',
            'ncodpersona' => 'required|exists:persona,ncodpersona',
            'privacidad' => 'required',
        ]);
        //recuperamos datos
        $data = $request->json()->all();
        //creamos el nuevo dato en la bd y lo guardamos en un variable
        $create = TipoPlato::create([
            'cnombretipoplato' => $data['cnombretipoplato'],
            'ncodpersona' => $data['ncodpersona'],
            'privacidad' => $data['privacidad']
        ]);
        //retornando datos correpondientes
        return response()->json(Utilitarios::messageOKC($create),201);
    }

    //Función para actualizar los datos
    function update(Request $request){
        //validación de datos
        $this->validate($request,[
            'ncodtipoplato' => 'required|exists:tipoplato',
            'cnombretipoplato' => 'required',
            'privacidad' => 'required',
        ]);
        $data = $request->json()->all();
        $tipoplato = TipoPlato::where('ncodtipoplato',$data['ncodtipoplato'])->first();
        $tipoplato->cnombretipoplato = $data['cnombretipoplato'];
        $tipoplato->privacidad = $data['privacidad'];
        $tipoplato->save();
        return response()->json(Utilitarios::messageOKU($tipoplato),200);
    }
}
