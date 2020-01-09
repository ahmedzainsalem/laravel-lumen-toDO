<?php    
        
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
?>      