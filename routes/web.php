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
$router->get('/permiso',['uses'=>'PermisoController@index']);
$router->post('/permiso',['uses'=>'PermisoController@createPermiso']);
$router->put('/permiso',['uses'=>'PermisoController@updatePermiso']);

//routing para usuario

$router->get('/usuario',['uses'=>'UsuarioController@index']);
$router->post('/usuario',['uses'=>'UsuarioController@createUsuario']);
$router->put('/usuario',['uses'=>'UsuarioController@updateUsuario']);
