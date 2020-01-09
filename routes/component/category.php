<?php    
        
       // "/api/todo  -- Get All the category Items
      $router->get('category', 'CategoriesController@index');
      // "/api/todo  -- Create a New category Item
      $router->post('category/create','CategoriesController@store');
      // "/api/todo/1  Show category Details
      $router->get('category/show/{id}', 'CategoriesController@show');
      // "/api/todo/1  Edit a Category
      $router->put('category/update/{id}', 'CategoriesController@update');
      // "/api/todo /1 Delete a Category Item
      $router->delete('category/delete/{id}', 'CategoriesController@destroy');
      
?>      