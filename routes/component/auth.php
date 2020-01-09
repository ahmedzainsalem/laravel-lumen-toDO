<?php    
     //  "/api/register
      $router->post('register', 'RegisterController@register');
      // Matches "/api/login
      $router->post('login', 'RegisterController@login');
?>      