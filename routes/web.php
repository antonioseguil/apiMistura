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
$router->group(['middleware' => ['auth','json']],function () use ($router){

    //para las que tienen que agregar algo a la bd, las demas son puro get
    $router->group(['middleware' => ['notNull']],function () use ($router){
        //SE VA NECESTIAR ESTAR AUTENTICADO PARA ACTUALIZAR TUS DATOS
        //CRUD de la tabla USUARIO
        $router->put('/update/usuario',['uses'=>'UsuarioController@update']);

        // --------------------------------------------------------

        //CRUD DE LA TABLA TIPO USUARIO


        //CREACION DE TIPO USUARIO
        $router->post('/tipousuario',['uses'=>'TipoUsuarioController@create']);
        //ACTUALIZACIÓN DEL TIPO DE USUARIO
        $router->put('/update/tipousuario',['uses'=>'TipoUsuarioController@update']);
        //AGREGADO DE UN SOLO PERMISO PARA USUARIO
        $router->post('/tipousuario/one/permiso',['uses'=>'TipoUsuarioController@setPermisoUsuario']);
        //AGREGADO DE MUCHOS PERMISOS PARA UN SOLO USUARIO
        $router->post('/tipousuario/more/permiso',['uses'=>'TipoUsuarioController@setMorePermisoUsuario']);

        //----------------------------------------------------------------

        //CRUD PARA LA TABLA PERMISO

        //Creación de permiso
        $router->post('/permiso',['uses'=>'PermisoController@create']);
        //Actualización de permiso
        $router->put('/update/permiso',['uses'=>'PermisoController@update']);

        // ---------------------------------------------------------------

        //CRUD PARA LA TABLA NEGOCIO


        //Crea un negocio
        $router->post('/negocio',['uses'=>'NegocioController@create']);
        //Actualiza el negocio
        $router->put('/update/negocio',['uses'=>'NegocioController@update']);

        //TABLA USUARIO NEGOCIO
        //Agregar usuario al negocio
        $router->post('/negocio/usuario/add',['uses'=>'UsuarioNegocioController@create']);
        //TODO * Falta agregar el cambio de estado al negocio

        // ----------------------------------------------------------------

        //CRUD PARA LA TABLA EVENTO


        //crear un evento
        $router->post('/evento',['uses'=>'EventoController@create']);
        //actualizar un evento
        $router->put('/update/evento',['uses'=>'EventoController@update']);

        //METODOS PARA AGREGAR LAS SECCIONES A LOS EVENTOS
        //Para agregar una seccion, sola una
        $router->post('/evento/one/seccion',['uses'=>'EventoController@setSeccionEvento']);
        //Para agregar varias secciones en una sola petición
        $router->post('/evento/more/seccion',['uses'=>'EventoController@setMoreSeccionEvento']);

        //TODO FALTA AGREGAR LAS BUSQUEDAS DE EVENTOS
        //TODO FALTA AGREGAR LOS CAMBIOS DE ESTADO EN LA TABLA SECCION EVENTO
        //TODO FALTA AGREGAR EL WHERE EN GET DE LISTA PARA QUE APARESCAN SOLO CON LAS DE "p"

        // -------------------------------------------------------------------

        //CRUD DE LA TABLA SECCION STAND

        //crear un seccion
        $router->post('/seccionstand',['uses'=>'SeccionStandController@create']);
        //actualizar una seccion
        $router->put('/update/seccionstand',['uses'=>'SeccionStandController@update']);

        // -------------------------------------------------------------------

        //CRUD DE LA TABLA SECCION STAND

        $router->post('/stand',['uses'=>'StandController@create']);
        $router->put('/update/stand',['uses'=>'StandController@update']);

        // --------------------------------------------------------------------

    });

    //TABLA TIPO USUARIO LISTA
    //traer lista de tipo de usuario
    $router->get('/lista/tipousuario',['uses'=>'TipoUsuarioController@index']);

    //Traer una lista de los permisos
    $router->get('/lista/permiso',['uses'=>'PermisoController@index']);

    //Trae una lista de los negocios
    $router->get('/lista/negocio',['uses'=>'NegocioController@index']);

    //------------------------------------------------

    //trear los eventos
    $router->get('/lista/evento',['uses'=>'EventoController@index']);
    // TODO EVENTO BUSQUEDA DE EVENTO POR ID DE SECCION
    $router->get('/lista/evento/{ncodseccion}',['uses'=>'EventoController@setEventoSeccion']);

    //---------------------------------------------

    //lista de seccion de stand
    $router->get('/lista/seccionstand',['uses'=>'SeccionStandController@index']);

    //lista de stand
    $router->get('/lista/stand',['uses'=>'StandController@index']);

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------





















    //CRUD de tabla TIPOPLATO
    //funcional
    //traer platos
    $router->get('/lista/tipoplato',['uses'=>'TipoPlatoController@index']);
    //crear plato
    $router->post('/tipoplato',['uses'=>'TipoPlatoController@create']);
    //actualizar plato
    $router->put('/update/tipoplato',['uses'=>'TipoPlatoController@update']);




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



