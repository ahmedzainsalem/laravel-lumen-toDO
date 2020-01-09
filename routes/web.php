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

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    /*
    Auth
    */
    require_once 'component/auth.php';

    /*
    User
    */
    require_once 'component/user.php';
    /*
    toDo
    */
    require_once 'component/todo.php';
    /*
    Category
    */
    require_once 'component/category.php';

 });
