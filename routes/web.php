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
     //  "/api/register
      $router->post('register', 'RegisterController@register');
      // Matches "/api/login
      $router->post('login', 'RegisterController@login');
       // Matches "/api/profile
      $router->get('profile', 'UserController@profile');

      // Matches "/api/users/1 
      //get one user by id
      $router->get('users/{id}', 'UserController@singleUser');
      // Matches "/api/users
      $router->get('users', 'UserController@allUsers');
      // "/api/logout
      $router->get('logout', 'RegisterController@logout');


       // "/api/todo  -- Get All the ToDo Items
      $router->get('todo', 'TodoController@index');
      // "/api/todo  -- Create a New ToDo Item
      $router->post('todo/create','TodoController@store');
      // "/api/todo/1  Show toDo Details
      $router->get('todo/show/{id}', 'TodoController@show');
      // "/api/todo/1  Edit a ToDo
      $router->put('todo/update/{id}', 'TodoController@update');
      // "/api/todo /1 Delete a ToDo Item
      $router->delete('todo/delete/{id}', 'TodoController@destroy');
      // "/api/todo  -- Search
      $router->post('todo/search','TodoController@filter');
 });
