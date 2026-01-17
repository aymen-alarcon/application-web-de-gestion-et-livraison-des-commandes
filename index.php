<?php

use App\Controller\AuthController;
use App\core\Router;
use App\Database\DatabaseConnection;

require __DIR__ . "/vendor/autoload.php";

session_start();

$db = new DatabaseConnection;
$conn = $db->connect();

$controller = new AuthController($conn);

$router = new Router;
// $router->get();
$router->post("/Login", [$controller, "login"]);
$router->post("/Create", [$controller, "login"]);

$router->resolve();