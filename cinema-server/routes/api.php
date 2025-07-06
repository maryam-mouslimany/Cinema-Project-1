<?php

class Api{

    public $apis = [
        '/login'     => ['controller' => 'AuthenticationController', 'method' => 'login'],
        '/register'     => ['controller' => 'AuthenticationController', 'method' => 'register'],
        '/profile'     => ['controller' => 'UserController', 'method' => 'viewProfile'],
        '/delete'     => ['controller' => 'UserController', 'method' => 'deleteUser'],
        '/update'     => ['controller' => 'UserController', 'method' => 'updateUser'],
        '/movies'     => ['controller' => 'MovieController', 'method' => 'getMovies'],

    ];

    public function route($request){
        if (isset($this->apis[$request])) {
        $controller_name = $this->apis[$request]['controller']; //if $request == /articles, then the $controller_name will be "ArticleController" 
        $method = $this->apis[$request]['method'];
        require_once "controllers/{$controller_name}.php";
        $controller = new $controller_name($mysqli);
        if (method_exists($controller, $method)) {
            $controller->$method();
        } else 
            echo "Error: Method {$method} not found in {$controller_name}.";
    } else 
        echo "404 Not Found";
    }
}
?>