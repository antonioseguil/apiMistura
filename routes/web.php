<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//TODO * ENTORNO DE PRUEBA PARA LOGUEO Y REGISTRO DE USUARIO
//TODO * ARREGLANDO API REST, NO SE VA UTILIZAR LOS MIDDLEWARE POR EL MOMENTO
//se esta usando los permisos de tipo json y que no sea nulo lo datos enviados
$router->group(['middleware'=>['json','notNull']],function () use ($router){

    //funcion anonima para INGRESO DE USUARIO(PERSONAS)
    $router->post('/usuario/login',['uses' => 'UsuarioController@getLoginUser']);

    //path para CREACIÓN DE USUARIO
    $router->post('/usuario',['uses'=>'UsuarioController@create']);
    //todavia no se utiliza
    //$router->get('/usuario',['uses'=>'UsuarioController@index']);
    //$router->put('/usuario',['uses'=>'UsuarioController@update']);

});

// ------------------------------------------------------------------------------------------------

//TODO * entorno para usuario validados,

//grupo de rutas para WEB, uso para web
$router->group(['middleware' => ['auth','json','notNull']],function () use ($router){

    //CRUD de tabla TIPOUSUARIO
    //funcional
    $router->get('/tipousuario',['uses'=>'TipoUsuarioController@index']);
    $router->post('/tipousuario',['uses'=>'TipoUsuarioController@create']);
    $router->put('/tipousuario',['uses'=>'TipoUsuarioController@update']);

    //routing para permisos
    //funcional
    $router->get('/permiso',['uses'=>'PermisoController@index']);
    $router->post('/permiso',['uses'=>'PermisoController@create']);
    $router->put('/permiso',['uses'=>'PermisoController@update']);



    //CRUD de tabla EVENTO
    //funcional
    $router->get('/evento',['uses'=>'EventoController@index']);
    $router->post('/evento',['uses'=>'EventoController@create']);
    $router->put('/evento',['uses'=>'EventoController@update']);

    //CRUD de tabla TIPOPLATO
    //funcional
    $router->get('/tipoplato',['uses'=>'TipoPlatoController@index']);
    $router->post('/tipoplato',['uses'=>'TipoPlatoController@create']);
    $router->put('/tipoplato',['uses'=>'TipoPlatoController@update']);

    //CRUD de tabla NEGOCIO
    //funcional
    $router->get('/negocio',['uses'=>'NegocioController@index']);
    $router->post('/negocio',['uses'=>'NegocioController@create']);
    //TODO -- EL ENCARGADO DE ACTUALIZAR LOS DATOS DEL NEGOCIO ES EL ENCARGADO DEL NEGOCIO, MOMENTANIO
    $router->put('/negocio',['uses'=>'NegocioController@update']);

    //CRUD de tabla SECCIONSTAND
    //funcional
    $router->get('/seccionstand',['uses'=>'SeccionStandController@index']);
    $router->post('/seccionstand',['uses'=>'SeccionStandController@create']);
    $router->put('/seccionstand',['uses'=>'SeccionStandController@update']);

    //CRUD de tabla UsuarioTipoPermiso
    //funcional
    //TODO * falta agregar funcion para eliminar.
    $router->get('/tipopermiso',['uses'=>'UsuarioTipoPermisoController@index']);
    $router->post('/tipopermiso',['uses'=>'UsuarioTipoPermisoController@create']);
    $router->put('/tipopermiso',['uses'=>'UsuarioTipoPermisoController@update']);


    // TODO - CREACION DE MIDDLEWARE PARA LOGUEO DE NEGOCIO

    //routing para plato
    //funcional
    $router->get('/plato',['uses'=>'PlatoController@index']);
    $router->post('/plato',['uses'=>'PlatoController@create']);
    $router->put('/plato',['uses'=>'PlatoController@update']);

    //routing para stand
    //funcional
    $router->get('/stand',['uses'=>'StandController@index']);
    $router->post('/stand',['uses'=>'StandController@create']);
    $router->put('/stand',['uses'=>'StandController@update']);

    //routing para LISTA PRECIO
    //funcional
    $router->get('/listaprecio',['uses'=>'ListaPrecioController@index']);
    $router->post('/listaprecio',['uses'=>'ListaPrecioController@create']);
    $router->put('/listaprecio',['uses'=>'ListaPrecioController@update']);

    //routing para DETALLE LISTA PRECIO
    //funcional
    $router->get('/detlistaprecio',['uses'=>'DetListaPrecioController@index']);
    $router->post('/detlistaprecio',['uses'=>'DetListaPrecioController@create']);
    $router->put('/detlistaprecio',['uses'=>'DetListaPrecioController@update']);


    //routing para tabla RESERVA
    //funcional
    $router->get('/reserva',['uses'=>'ReservaController@index']);
    $router->post('/reserva',['uses'=>'ReservaController@create']);
    $router->put('/reserva',['uses'=>'ReservaController@update']);

    //routing para tabla DETRESERVA
    //funcional
    $router->get('/detreserva',['uses'=>'DetReservaController@index']);
    $router->post('/detreserva',['uses'=>'DetReservaController@create']);
    $router->put('/detreserva',['uses'=>'DetReservaController@update']);
});



/*
 * Prueba de store procedure con laravel lumen
 * $router->get('/tipoplato/sp',['uses'=>'TipoPlatoController@spPrueba']);
 */

// TODO* comienzo de la revison



