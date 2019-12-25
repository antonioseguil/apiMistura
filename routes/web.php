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

/*
|
| Iniciar el servidor de laravel:
| php -S localhost:8000 -t public
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/prueba', function (\Illuminate\Http\Request $request) use ($router) {
    $prueba = $request->json()->all();
    return response()->json(["rpta" => array_key_exists('prueba',$prueba) ],200) ;
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


});

// ------------------------------------------------------------------------------------------------

//TODO * entorno para usuario validados,

//grupo de rutas para WEB, validando el api_token y que sea json
$router->group(['middleware' => ['json']],function () use ($router){

    //CRUD de la tabla USUARIO
    $router->put('/update/usuario',['uses'=>'UsuarioController@update']);
    //cambio de estado para un usuario
    $router->delete('/status/usuario',['uses'=>'UsuarioController@personaDelete']);

    /**************/

    //busqueda de persona por estado y tipo
    $router->get('/persona/status/{estado}/{tipousuario}',['uses'=>'UsuarioController@searchUsuario']);
    //busqueda de persona por codigo
    $router->get('/persona/{codpersona}',['uses'=>'UsuarioController@getPersona']);
    //trae todos los eventos creados por una usuario [tipo usuario => administrador]
    $router->get('/persona/evento/{codpersona}',['uses'=>'UsuarioController@getPersonaEvento']);
    //trae todos los eventos creados por una usuario y sus detalle correspondiente [tipo usuario => administrador]
    $router->get('/persona/evento/detalle/{codpersona}',['uses'=>'EventoController@getSeccionesPersona']);

    // ------------------------------------------------

    //CRUD DE LA TABLA TIPO USUARIO
    //CREACION DE TIPO USUARIO
    $router->post('/tipousuario',['uses'=>'TipoUsuarioController@create']);
    //ACTUALIZACIÓN DEL TIPO DE USUARIO
    $router->put('/update/tipousuario',['uses'=>'TipoUsuarioController@update']);
    //AGREGADO DE UN SOLO PERMISO PARA USUARIO
    $router->post('/tipousuario/one/permiso',['uses'=>'TipoUsuarioController@setPermisoUsuario']);
    //AGREGADO DE MUCHOS PERMISOS PARA UN SOLO USUARIO
    $router->post('/tipousuario/more/permiso',['uses'=>'TipoUsuarioController@setMorePermisoUsuario']);

    /*********************************/

    //traer lista de tipo de usuario
    $router->get('/lista/tipousuario',['uses'=>'TipoUsuarioController@index']);


    // ------------------------------------------------

    //CRUD PARA LA TABLA PERMISO
    //Creación de permiso
    $router->post('/permiso',['uses'=>'PermisoController@create']);
    //Actualización de permiso
    $router->put('/update/permiso',['uses'=>'PermisoController@update']);

     /***************************/

    //Traer una lista de los permisos
    //$router->get('/lista/permiso',['uses'=>'PermisoController@index']);

    // ------------------------------------------------

    //CRUD PARA LA TABLA NEGOCIO
    //Crea un negocio
    $router->post('/negocio',['uses'=>'NegocioController@create']);
    //Actualiza el negocio
    $router->put('/update/negocio',['uses'=>'NegocioController@update']);
    //'eliminar' negocio
    $router->delete('/status/negocio/{codnegocio}',['uses'=>'NegocioController@negocioDelete']);

    /********************************/

    //Trae una lista de los negocios
    $router->get('/lista/negocio',['uses'=>'NegocioController@index']);
    //Trae una lista de los negocios segun su estatus
    $router->get('/lista/negocio/status/{status}',['uses'=>'NegocioController@getNegocioStatus']);

    //------------------------------------------------

    //CRUD PARA LA TABLA USUARIO NEGOCIO
    //Agregar usuario al negocio
    $router->post('/negocio/usuario/add',['uses'=>'UsuarioNegocioController@create']);
    //TODO * Falta agregar el cambio de estado al negocio

    // ----------------------------------------------------------------

    //CRUD PARA LA TABLA EVENTO
    //crear un evento
    $router->post('/evento',['uses'=>'EventoController@create']);
    //actualizar un evento
    $router->put('/update/evento',['uses'=>'EventoController@update']);
    // 'eliminar' un evento
    $router->delete('/status/evento/{codevento}',['uses'=>'EventoController@eventoTerminar']);

    //METODOS PARA AGREGAR LAS SECCIONES A LOS EVENTOS
    //Para agregar una seccion, sola una
    $router->post('/evento/one/seccion',['uses'=>'EventoController@setSeccionEvento']);
    //Para agregar varias secciones en una sola petición
    $router->post('/evento/more/seccion',['uses'=>'EventoController@setMoreSeccionEvento']);

    /**********************************/

    //trear los eventos
    $router->get('/lista/evento',['uses'=>'EventoController@index']);
    //traer eventos segun el estado del evento
    $router->get('/lista/evento/status/{status}',['uses'=>'EventoController@getEventoStatus']);
    // TODO EVENTO BUSQUEDA DE EVENTO POR ID DE SECCION
    $router->get('/lista/evento/{ncodseccion}',['uses'=>'EventoController@setEventoSeccion']);
    // TODO BUSQUEDA DE SECCIONES DE LOS EVENTOS
    $router->get('/lista/evento/seccion/{codevento}',['uses'=>'EventoController@setSecciones']);


    //---------------------------------------------

    //CRUD DE LA TABLA SECCION STAND
    //crear un seccion
    $router->post('/seccionstand',['uses'=>'SeccionStandController@create']);
    //actualizar una seccion
    $router->put('/update/seccionstand',['uses'=>'SeccionStandController@update']);

    /**********************************/

    //lista de seccion de stand
    $router->get('/lista/seccionstand',['uses'=>'SeccionStandController@index']);

    //----------------------------------------------

    //CRUD DE LA TABLA  STAND
    //crear un stand
    $router->post('/stand',['uses'=>'StandController@create']);
    //actualizar un stand
    $router->put('/update/stand',['uses'=>'StandController@update']);
    //'eliminar' un stand
    $router->delete('/status/stand/{codstand}',['uses'=>'StandController@standDelete']);

    /**************************/

    //lista de stand
    $router->get('/lista/stand',['uses'=>'StandController@index']);
    //lista de stand segun su status status
    $router->get('/lista/stand/{status}',['uses'=>'StandController@getStandStatus']);

    //-----------------------------------------------------------

    //CRUD de tabla TIPOPLATO
    //crear tipo plato
    $router->post('/tipoplato',['uses'=>'TipoPlatoController@create']);
    //actualizar tipo plato
    $router->put('/update/tipoplato',['uses'=>'TipoPlatoController@update']);

    /******************/

    //traer tipo platos
    $router->get('/lista/tipoplato',['uses'=>'TipoPlatoController@index']);

    //-----------------------------------------------------------

    //CRUD de tabla PLATO
    //creación plato
    $router->post('/plato',['uses'=>'PlatoController@create']);
    //actualizar tipo plato
    $router->put('/update/plato',['uses'=>'PlatoController@update']);

    //Agregar lista de precio a un plato(uno solo)
    $router->post('/plato/lista',['uses'=>'DetListaPrecioController@create']);
    //Agregar lista de precio a un plato(varios)
    $router->post('/plato/more/lista',['uses'=>'DetListaPrecioController@moreCreate']);

    /*******************************/

    //lista de platos
    $router->get('/lista/plato',['uses'=>'PlatoController@index']);
    //TODO * LISTA DE TODOS LOS PLATOS SEGUN EVENTO Y SECCION DEL EVENTO
    $router->get('/lista/platos/{codevento}/{ncodseccion}',['uses'=>'PlatoController@setEventoSeccion']);
    //busqueda de detalle de un plato
    $router->get('/detalle/plato/{codplato}/{codlistaprecio}',['uses'=>'PlatoController@getDetallePlato']);
    //lista de todos los platos segun seccion en orden asc
    $router->get('/all/platos/{codseccion}/asc',['uses'=>'PlatoController@getAllPlatosAsc']);
    //-----------------------------------------------------------



    //CRUD de tabla LISTA PRECIO
    //crear una lista de precio
    $router->post('/listaprecio',['uses'=>'ListaPrecioController@create']);
    //actualizar una lista de precio
    $router->put('/update/listaprecio',['uses'=>'ListaPrecioController@update']);
    //falta buscar la lista de precio por plato

    /***********************/

    //traer la lista de platos
    $router->get('/lista/listaprecio',['uses'=>'ListaPrecioController@index']);

    //------------------------------------------------------------------------------------

    //CRUD de tabla RESERVA
    //creación de reserva
    $router->post('/reserva',['uses'=>'ReservaController@create']);
    //actualizar una reserva
    $router->put('/update/reserva',['uses'=>'ReservaController@update']);
    //cambiar estado a una reserva a 'ENTREGADO'
    $router->post('/status/reserva/e',['uses'=>'DetReservaController@reservaStatusEntregado']);
    //cambiar estado a una reserva a 'CANCELADO'
    $router->post('/status/reserva/c',['uses'=>'DetReservaController@reservaStatusCancelado']);

    //Fuciones para los detalles de la reserva
    //agregar detalle de reserva
    $router->post('/detreserva',['uses'=>'DetReservaController@create']);
    //agregar muchos detalles a la reserva
    $router->post('/detreserva/more',['uses'=>'DetReservaController@moreCreate']);

    /***************************************************/

    //función para ver las reservas de un cliente
    $router->get('/reserva/cliente/{codcliente}',['uses'=>'ResevaController@reservasCliente']);
    //función para ver los detalles de una reserva
    $router->get('/reserva/detalle/{codreserva}',['uses'=>'DetReservaController@detalleReserva']);



// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------


























    //CRUD de tabla UsuarioTipoPermiso
    //funcional
    //TODO * falta agregar funcion para eliminar.
    $router->get('/lista/tipopermiso',['uses'=>'UsuarioTipoPermisoController@index']);
    $router->post('/tipopermiso',['uses'=>'UsuarioTipoPermisoController@create']);
    $router->put('/update/tipopermiso',['uses'=>'UsuarioTipoPermisoController@update']);



    //routing para tabla DETRESERVA
    //funcional
    //$router->get('/lista/detreserva',['uses'=>'DetReservaController@index']); innecesario..

    //$router->put('/update/detreserva',['uses'=>'DetReservaController@update']);
});



/*
 * Prueba de store procedure con laravel lumen
 * $router->get('/tipoplato/sp',['uses'=>'TipoPlatoController@spPrueba']);
 */

$router->group(['middleware'=>['json','auth']],function () use ($router){
    $router->get('/lista/permiso',['uses'=>'PermisoController@index']);
});



