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


//routing para permisos
//funcional
$router->get('/permiso',['uses'=>'PermisoController@index']);
$router->post('/permiso',['uses'=>'PermisoController@create']);
$router->put('/permiso',['uses'=>'PermisoController@update']);

//routing para tipo de usuario
//funcional
$router->get('/tipousuario',['uses'=>'TipoUsuarioController@index']);
$router->post('/tipousuario',['uses'=>'TipoUsuarioController@create']);
$router->put('/tipousuario',['uses'=>'TipoUsuarioController@update']);

//routing para usuario
//funcional
$router->get('/usuario',['uses'=>'UsuarioController@index']);
$router->post('/usuario',['uses'=>'UsuarioController@create']);
$router->put('/usuario',['uses'=>'UsuarioController@update']);

//routing para evento
//funcional
$router->get('/evento',['uses'=>'EventoController@index']);
$router->post('/evento',['uses'=>'EventoController@create']);
$router->put('/evento',['uses'=>'EventoController@update']);

//routing para negocio
//funcional
$router->get('/negocio',['uses'=>'NegocioController@index']);
$router->post('/negocio',['uses'=>'NegocioController@create']);
$router->put('/negocio',['uses'=>'NegocioController@update']);

//routing para seccion stand
//funcional
$router->get('/seccionstand',['uses'=>'SeccionStandController@index']);
$router->post('/seccionstand',['uses'=>'SeccionStandController@create']);
$router->put('/seccionstand',['uses'=>'SeccionStandController@update']);

//routing para tipo de plato
//funcional
$router->get('/tipoplato',['uses'=>'TipoPlatoController@index']);
$router->post('/tipoplato',['uses'=>'TipoPlatoController@create']);
$router->put('/tipoplato',['uses'=>'TipoPlatoController@update']);

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

// TODO* falta terminar las tablas cigotes, de stand-plato y permiso-tipo usuario

