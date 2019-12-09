<?php


namespace App;


class Utilitarios
{
    //TODO* CREACIÓN DE CLASE PARA PERSONALIZAR LA RESPUESTAS DE JSON, PRIMERA PRUEBA
    //función para retornar mensajes de respuesta cuando se crea correctamente un objeto
    public static function messageOKC($dataReponse = array()){
        $returnData = array('rpta' => '1', 'msg' => 'Creado correctamente', 'obj' => $dataReponse);
        return $returnData;
    }

    //función para retornar mensajes de respuesta cuando se actualiza correctamente un objeto
    public static function messageOKU($dataReponse = array()){
        $returnData = array('rpta' => '1', 'msg' => 'Actualizado correctamente', 'obj' => $dataReponse);
        return $returnData;
    }

    //función para retornar mensajes de respuesta cuando se produce un error
    public static function messageERRO($dataReponse = array()){
        $returnData = array('rpta' => '0', 'msg' => 'Error de servidor, por favor revisar su petición', 'obj' => $dataReponse);
        return $returnData;
    }

    //función para retornar mensajes de respuesta cuando se agreguen varios datos
    public static function messageMoreData($dataReponse = array(),$cantidad = 1){
        $returnData = array('rpta' => '1', 'msg' => 'Se agrego correctamente los datos enviados','cantidad' => $cantidad ,'obj' => $dataReponse);
        return $returnData;
    }

    //función para retornar mensajes de respuesta generico
    public static function messageOK($dataReponse = array()){
        $returnData = array('rpta' => '1', 'msg' => 'Se realizo la consulta','obj' => $dataReponse);
        return $returnData;
    }

}
