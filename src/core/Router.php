<?php

namespace App\core;

class Router{
    private ?array $routes;

    function get(string $path, callable $callback){
        $this->routes["GET"][$path] = $callback;
    }

    function post(string $path, callable $callback){
        $this->routes["POST"][$path] = $callback;
    }

    function resolve(){
        $methode = $_SERVER["REQUEST_METHOD"];
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        $callback = $this->routes[$methode][$path] ?? [];

        if ($callback == NULL) {
            http_response_code(404);
            echo "Page Not Found";
        }

        return $callback();
    }
}