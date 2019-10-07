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
//funcion anonima, donde todos pueden entrar
$router->post('/usuario/login',['uses' => 'UsuarioController@getToken']);

//grupo de rutas para WEB, uso para web
$router->group(['middleware' => ['auth','json']],function () use ($router){

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

    //CRUD de tabla USUARIO
    //funcional
    $router->get('/usuario',['uses'=>'UsuarioController@index']);
    $router->post('/usuario',['uses'=>'UsuarioController@create']);
    $router->put('/usuario',['uses'=>'UsuarioController@update']);

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
    //TODO EL ENCARGADO DE ACTUALIZAR LOS DATOS DEL NEGOCIO ES EL ENCARGADO DEL NEGOCIO, MOMENTANIO
    $router->put('/negocio',['uses'=>'NegocioController@update']);

    //CRUD de tabla SECCIONSTAND
    //funcional
    $router->get('/seccionstand',['uses'=>'SeccionStandController@index']);
    $router->post('/seccionstand',['uses'=>'SeccionStandController@create']);
    $router->put('/seccionstand',['uses'=>'SeccionStandController@update']);

});

// TODO CREACION DE MIDDLEWARE PARA LOGUEO DE NEGOCIO

//routing para plato
//funcional
$router->get('/plato',['uses'=>'PlatoController@index']);
$router->post('/plato',['uses'=>'PlatoController@create']);
$router->put('/plato',['uses'=>'PlatoController@update']);

//routing para stand
//funcinal
$router->get('/stand',['uses'=>'StandController@index']);
$router->post('/stand',['uses'=>'StandController@create']);
$router->put('/stand',['uses'=>'StandController@update']);

/*
 * Prueba de store procedure con laravel lumen
 * $router->get('/tipoplato/sp',['uses'=>'TipoPlatoController@spPrueba']);
 */

// TODO* falta terminar las tablas cigotes, de stand-plato y permiso-tipo usuario

// ejemplo para el uso restricciones


