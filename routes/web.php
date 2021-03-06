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
    return response()->json(["rpta" => array_key_exists('prueba', $prueba)], 200);
});

//TODO * ENTORNO DE PRUEBA PARA LOGUEO Y REGISTRO DE USUARIO
//TODO * ARREGLANDO API REST, NO SE VA UTILIZAR LOS MIDDLEWARE POR EL MOMENTO
//se esta usando los permisos de tipo json y que no sea nulo lo datos enviados
$router->group(['middleware' => ['json']], function () use ($router) {

    //funcion anonima para INGRESO DE USUARIO(PERSONAS)
    $router->post('/usuario/login', ['uses' => 'UsuarioController@getLoginUser']);

    //path para CREACIÓN DE USUARIO
    $router->post('/usuario', ['uses' => 'UsuarioController@create']);
    //todavia no se utiliza
    //$router->get('/usuario',['uses'=>'UsuarioController@index']);


});

// ------------------------------------------------------------------------------------------------

//TODO * entorno para usuario validados,

//grupo de rutas para WEB, validando el api_token y que sea json
$router->group(['middleware' => ['json', 'auth']], function () use ($router) {

    //CRUD de la tabla USUARIO, USUARIO NEGOCIO
    //Agregar usuario al negocio
    $router->post('/usuario/negocio', ['uses' => 'UsuarioController@createNegocio']);
    //Actualizar los datos de un usuario
    $router->put('/update/usuario', ['uses' => 'UsuarioController@update']);
    //cambio de ckey del usuario
    $router->put('/update/key/{codigoPersona}/{key}', ['uses' => 'UsuarioController@ckeyUpdate']);
    //cambio de estado para un usuario
    $router->delete('/status/usuario', ['uses' => 'UsuarioController@personaDelete']);
    
    /**************/

    //login con Ckey
    $router->get('/login/key/{codigoPersona}/{key}', ['uses' => 'UsuarioController@ckeyLogin']);
    //busqueda de persona por estado y tipo
    $router->get('/persona/status/{estado}/{tipousuario}', ['uses' => 'UsuarioController@searchUsuario']);
    //busqueda de persona por codigo
    $router->get('/persona/{codpersona}', ['uses' => 'UsuarioController@getPersona']);
    //trae todos los eventos creados por una usuario [tipo usuario => administrador]
    $router->get('/persona/evento/{codpersona}', ['uses' => 'UsuarioController@getPersonaEvento']);
    //trae todos los eventos creados por una usuario y sus detalle correspondiente [tipo usuario => administrador]
    $router->get('/persona/evento/detalle/{codpersona}', ['uses' => 'EventoController@getSeccionesPersona']);

    // ------------------------------------------------

    //CRUD DE LA TABLA TIPO USUARIO
    //CREACION DE TIPO USUARIO
    $router->post('/tipousuario', ['uses' => 'TipoUsuarioController@create']);
    //ACTUALIZACIÓN DEL TIPO DE USUARIO
    $router->put('/update/tipousuario', ['uses' => 'TipoUsuarioController@update']);
    //AGREGADO DE UN SOLO PERMISO PARA USUARIO
    $router->post('/tipousuario/one/permiso', ['uses' => 'TipoUsuarioController@setPermisoUsuario']);
    //AGREGADO DE MUCHOS PERMISOS PARA UN SOLO USUARIO
    $router->post('/tipousuario/more/permiso', ['uses' => 'TipoUsuarioController@setMorePermisoUsuario']);

    /*********************************/

    //traer lista de tipo de usuario
    $router->get('/lista/tipousuario', ['uses' => 'TipoUsuarioController@index']);
    //traer lista de tipo de usuario para combo
    $router->get('/combo/tipousuario', ['uses' => 'TipoUsuarioController@getTipoUsuarioCombo']);


    // ------------------------------------------------

    //CRUD PARA LA TABLA PERMISO
    //Creación de permiso
    $router->post('/permiso', ['uses' => 'PermisoController@create']);
    //Actualización de permiso
    $router->put('/update/permiso', ['uses' => 'PermisoController@update']);

    /***************************/

    //Traer una lista de los permisos
    $router->get('/lista/permiso', ['uses' => 'PermisoController@index']);

    // ------------------------------------------------

    //CRUD PARA LA TABLA NEGOCIO
    //Crea un negocio
    $router->post('/negocio', ['uses' => 'NegocioController@create']);
    //Actualiza el negocio
    $router->put('/update/negocio', ['uses' => 'NegocioController@update']);
    //'eliminar' negocio
    $router->delete('/status/negocio/{codnegocio}', ['uses' => 'NegocioController@negocioDelete']);

    /********************************/

    //Trae una lista de los negocios
    $router->get('/lista/negocio/{codpersona}', ['uses' => 'NegocioController@getNegocioPersonaPublic']);
    //Trae una lista de los negocios para combo
    $router->get('/combo/negocio/{codpersona}', ['uses' => 'NegocioController@getNegocioPersonaPublicCombo']);
    //Trae una lista de los negocios segun su estatus
    $router->get('/lista/negocio/status/{status}', ['uses' => 'NegocioController@getNegocioStatus']);
    //Trae una lista de los usuario que tiene le negocio
    $router->get('/lista/usuario/negocio/{codpersona}', ['uses' => 'NegocioController@getUsuarioNegocio']);
    
    

    // ----------------------------------------------------------------

    //CRUD PARA LA TABLA EVENTO
    //crear un evento
    $router->post('/evento', ['uses' => 'EventoController@create']);
    //actualizar un evento
    $router->put('/update/evento', ['uses' => 'EventoController@update']);
    //actualizar un cantidad de un stand de la seccion de un evento
    $router->put('/update/seccion/evento/stand', ['uses' => 'EventoController@updateCantidadStand']);
    // 'eliminar' un evento
    $router->delete('/status/evento/{codevento}/{status}', ['uses' => 'EventoController@eventoTerminar']);

    //METODOS PARA AGREGAR LAS SECCIONES A LOS EVENTOS
    //Para agregar una seccion, sola una
    $router->post('/evento/one/seccion', ['uses' => 'EventoController@setSeccionEvento']);
    //Para agregar varias secciones en una sola petición
    $router->post('/evento/more/seccion', ['uses' => 'EventoController@setMoreSeccionEvento']);

    /**********************************/

    //trear los eventos segun codigo de persona
    $router->get('/lista/evento', ['uses' => 'EventoController@index']);
    // traer datos de evento para combo
    $router->get('/combo/evento/{codpersona}', ['uses' => 'EventoController@getEventoPersonaCombo']);
    //traer eventos segun el estado del evento
    $router->get('/lista/evento/status/{status}', ['uses' => 'EventoController@getEventoStatus']);
    //BUSQUEDA DE EVENTO POR ID DE SECCION
    $router->get('/lista/evento/{ncodseccion}', ['uses' => 'EventoController@setEventoSeccion']);
    //BUSQUEDA DE SECCIONES DE LOS EVENTOS
    $router->get('/lista/evento/seccion/{codevento}', ['uses' => 'EventoController@setSecciones']);
    
    //REPORTE DE EVENTOS
    //por evento
    $router->get('/reporte/evento/{codevento}', ['uses' => 'EventoController@reporteEvento']);
    //por evento
    $router->get('/reporte/evento/{codevento}/{codseccion}', ['uses' => 'EventoController@reporteEventoSeccion']);

    //---------------------------------------------

    //CRUD DE LA TABLA SECCION STAND
    //crear un seccion
    $router->post('/seccionstand', ['uses' => 'SeccionStandController@create']);
    //actualizar una seccion
    $router->put('/update/seccionstand', ['uses' => 'SeccionStandController@update']);
    //actualizar el estado de una seccion de evento
    $router->delete('/update/eventoseccion/{codevento}/{codseccion}/{estado}', ['uses' => 'SeccionStandController@setEstadoEventoSeccion']);

    /**********************************/

    //lista de seccion de stand
    $router->get('/lista/seccionstand', ['uses' => 'SeccionStandController@index']);
    //lista de seccion de stand
    $router->get('/lista/seccionstand/{codpersona}', ['uses' => 'SeccionStandController@getSeccionesPersonaPublic']);
    //lista de seccion de stand con codigo de persona y esado publico
    $router->get('/combo/seccionstand/{codpersona}', ['uses' => 'SeccionStandController@getSeccionCombo']);

    //----------------------------------------------

    //CRUD DE LA TABLA STAND
    //crear un stand
    $router->post('/stand', ['uses' => 'StandController@create']);
    //actualizar un stand
    $router->put('/update/stand', ['uses' => 'StandController@update']);
    //'eliminar' un stand
    $router->delete('/status/stand/{codstand}', ['uses' => 'StandController@standDelete']);

    /**************************/

    //lista de stand
    $router->get('/lista/stand', ['uses' => 'StandController@index']);
    //lista de stand por negocio
    $router->get('/negocio/stand/{codnegocio}', ['uses' => 'StandController@getStandNegocio']);
    //lista de stand para combo
    $router->get('/combo/stand/{codevento}/{codseccion}', ['uses' => 'StandController@getStandCombo']);
    //lista de stand con detalle de negocio y cantidad
    $router->get('/stand/detalle/{codevento}/{codseccion}', ['uses' => 'StandController@getStandEventoSeccion']);
    //lista de stand segun su status status
    $router->get('/lista/stand/{status}', ['uses' => 'StandController@getStandStatus']);

    //REPORTE DE STAND
    //por stand
    $router->get('/reporte/stand/{codevento}/{codseccion}/{codstand}', ['uses' => 'StandController@reporteStand']);

    //-----------------------------------------------------------

    //CRUD de tabla TIPO PLATO
    //crear tipo plato
    $router->post('/tipoplato', ['uses' => 'TipoPlatoController@create']);
    //actualizar tipo plato
    $router->put('/update/tipoplato', ['uses' => 'TipoPlatoController@update']);

    /******************/

    //traer tipo de platos de una persona y estados publicos
    $router->get('/lista/tipoplato/{codpersona}', ['uses' => 'TipoPlatoController@getPlatoPersonaPublic']);
    //traer tipo de platos de una persona y estados publicos pero para listar un combo o select
    $router->get('/combo/tipoplato/{codpersona}', ['uses' => 'TipoPlatoController@getPlatoPersonaPublicCombo']);

    //-----------------------------------------------------------

    //CRUD de tabla PLATO
    //creación plato
    $router->post('/plato', ['uses' => 'PlatoController@create']);
    //actualizar plato
    $router->put('/update/plato', ['uses' => 'PlatoController@update']);
    //actualizar det de lista del palto
    $router->put('/update/detlistaplato', ['uses' => 'DetListaPrecioController@update']);

    //Agregar lista de precio a un plato(uno solo)
    $router->post('/plato/lista', ['uses' => 'DetListaPrecioController@create']);
    //Agregar lista de precio a un plato(varios)
    $router->post('/plato/more/lista', ['uses' => 'DetListaPrecioController@moreCreate']);

    /*******************************/

    //lista de platos segun persona y privacidad
    $router->get('/lista/plato/{codpersona}', ['uses' => 'PlatoController@getPlatoPersonaPublic']);
    //LISTA DE TODOS LOS PLATOS SEGUN EVENTO Y SECCION DEL EVENTO
    $router->get('/lista/platos/{codevento}/{ncodseccion}', ['uses' => 'PlatoController@setEventoSeccion']);
    //lista de todos los platos segun seccion en orden asc
    $router->get('/all/platos/{codseccion}/asc', ['uses' => 'PlatoController@getAllPlatosAsc']);
    //lista de platos segun persona y privacidad
    $router->get('/combo/plato/{codpersona}', ['uses' => 'PlatoController@getPlatoPersonaPublicCombo']);

    //-----------------------------------------------------------



    //CRUD de tabla LISTA PRECIO
    //crear una lista de precio
    $router->post('/listaprecio', ['uses' => 'ListaPrecioController@create']);
    //actualizar una lista de precio
    $router->put('/update/listaprecio', ['uses' => 'ListaPrecioController@update']);
    //falta buscar la lista de precio por plato

    /***********************/

    //traer la lista de platos
    $router->get('/lista/listaprecio', ['uses' => 'ListaPrecioController@index']);
    //traer la lista de platos para combo
    $router->get('/combo/listaprecio/{codstand}', ['uses' => 'ListaPrecioController@getListaComboStand']);
    //traer la lista de platos de un stand 
    $router->get('/listaprecio/platos/{codevento}/{codseccion}/{stand}', ['uses' => 'ListaPrecioController@getListaPlatosStandEvento']);

    //------------------------------------------------------------------------------------

    //CRUD de tabla RESERVA
    //creación de reserva
    $router->post('/reserva', ['uses' => 'ReservaController@create']);
    //actualizar una reserva
    $router->put('/update/reserva', ['uses' => 'ReservaController@update']);
    //cambiar estado a una reserva a 'ENTREGADO'
    $router->delete('/reserva/status/{codreserva}/{estatus}', ['uses' => 'ReservaController@reservaStatus']);

    //Fuciones para los detalles de la reserva
    //agregar detalle de reserva
    $router->post('/detreserva', ['uses' => 'DetReservaController@create']);
    //agregar muchos detalles a la reserva
    $router->post('/detreserva/more', ['uses' => 'DetReservaController@moreCreate']);

    /***************************************************/

    //función para ver las reservas de un cliente
    $router->get('/reserva/cliente/{codcliente}', ['uses' => 'ReservaController@reservasCliente']);
    //función para ver los reservas de un cliente, ya sea por fecha o por nombre evento
    $router->get('/reserva/cliente/{codcliente}/{valor}', ['uses' => 'ReservaController@reservasClienteFiltrado']);
    //función para ver los reservas de un cliente, por fecha y por nombre de evento
    $router->get('/reserva/cliente/{codcliente}/{fecha}/{evento}', ['uses' => 'ReservaController@reservasClienteFechaEvento']);


    // -----------------------------------------------------------------------------

    //CRUD de tabla VENTA
    $router->post('/reserva/venta',['uses' => 'VentaController@create']);

    // -----------------------------------------------------------------------------


























    //CRUD de tabla UsuarioTipoPermiso
    //funcional
    //TODO * falta agregar funcion para eliminar.
    $router->get('/lista/tipopermiso', ['uses' => 'UsuarioTipoPermisoController@index']);
    $router->post('/tipopermiso', ['uses' => 'UsuarioTipoPermisoController@create']);
    $router->put('/update/tipopermiso', ['uses' => 'UsuarioTipoPermisoController@update']);



    //routing para tabla DETRESERVA
    //funcional
    //$router->get('/lista/detreserva',['uses'=>'DetReservaController@index']); innecesario..

    //$router->put('/update/detreserva',['uses'=>'DetReservaController@update']);
});



/*
 * Prueba de store procedure con laravel lumen
 * $router->get('/tipoplato/sp',['uses'=>'TipoPlatoController@spPrueba']);
 */

/*$router->group(['middleware'=>['json','auth']],function () use ($router){
    $router->get('/lista/permiso',['uses'=>'PermisoController@index']);
});*/
