<?php

use App\Controller\AuthController;
use App\Controller\CommandeController;
use App\Controller\CommandeItemController;
use App\Controller\NotificationController;
use App\Controller\OfferController;
use App\Controller\RoleController;
use App\Controller\UserController;
use App\core\Router;
use App\Database\DatabaseConnection;

require __DIR__ . "/vendor/autoload.php";

session_start();

$db = new DatabaseConnection;
$conn = $db->connect();

$AuthController = new AuthController($conn);
$OrderController = new CommandeController($conn);
$OrderItemController = new CommandeItemController($conn);
$notificationController = new NotificationController($conn);
$offerController = new OfferController($conn);
$roleController = new RoleController($conn);
$userController = new UserController($conn);

$router = new Router;
$router->post("/Login", [$AuthController, "login"]);
$router->post("/Register", [$AuthController, "register"]);
$router->post("/User/Update", [$userController, "update"]);
$router->get("/User/Create", [$userController, "delete"]);
$router->post("/Order/Create", [$OrderController, "create"]);
$router->get("/Order/Read", [$OrderController, "read"]);
$router->post("/Order/Update", [$OrderController, "update"]);
$router->get("/Order/Delete", [$OrderController, "delete"]);
$router->post("/Order/OrderItems/Create", [$OrderItemController, "create"]);
$router->get("/Order/OrderItems/Read", [$OrderItemController, "read"]);
$router->post("/Order/OrderItems/Update", [$OrderItemController, "update"]);
$router->get("/Order/OrderItems/Delete", [$OrderItemController, "delete"]);
$router->post("/Notification/Create", [$notificationController, "create"]);
$router->get("/Notification/Read", [$notificationController, "read"]);
$router->post("/Notification/Update", [$notificationController, "update"]);
$router->get("/Notification/Delete", [$notificationController, "delete"]);
$router->post("/Offer/Create", [$offerController, "create"]);
$router->get("/Offer/Read", [$offerController, "read"]);
$router->post("/Offer/Update", [$offerController, "update"]);
$router->get("/Offer/Delete", [$offerController, "delete"]);
$router->post("/Role/Create", [$roleController, "create"]);
$router->get("/Role/Read", [$roleController, "read"]);
$router->post("/Role/Update", [$roleController, "update"]);
$router->get("/Role/Delete", [$roleController, "delete"]);

$router->resolve();