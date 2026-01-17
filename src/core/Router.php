<?php

namespace App\core;

class Router{
    private ?array $routes = [];
    private ?array $middleware = [];

    function get(string $path, callable $callback){
        $this->routes["GET"][$path] = $callback;
    }

    function post(string $path, callable $callback){
        $this->routes["POST"][$path] = $callback;
    }

    function middleware(string $path, callable $callback){
        $this->middleware[$path][] = $callback;
    }

    function resolve(){
        $method = $_SERVER["REQUEST_METHOD"];
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $path = explode("?", $path)[0];

        $callback = $this->routes[$method][$path] ?? [];

        if ($callback == NULL) {
            http_response_code(404);
            die ("Page Not Found");
        }

        foreach ($this->middleware[$path] ?? [] as $middleware) {
            $middleware();
        }

        return $callback();
    }
}