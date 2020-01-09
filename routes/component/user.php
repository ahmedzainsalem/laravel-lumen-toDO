<?php    
        // Matches "/api/profile
        $router->get('profile', 'UserController@profile');

        // Matches "/api/users/1 
        //get one user by id
        $router->get('users/{id}', 'UserController@singleUser');
        // Matches "/api/users
        $router->get('users', 'UserController@allUsers');
        // "/api/logout
        $router->get('logout', 'RegisterController@logout');
?>      