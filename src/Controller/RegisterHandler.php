<?php
require_once "../Entity/User.php";
require_once "../Repositories/UserRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class RegisterHandler {
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function register() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: ../../public/index.php");
        }

        $handler = new User();
        $handler->setUsername($_POST["username"]);
        $handler->setFirstName($_POST["first_name"]);
        $handler->setLastName($_POST["last_name"]);
        $handler->setPhone($_POST["phone"]);
        $handler->setPassword($_POST["password"]);
        $handler->setEmail($_POST["email"]);
        $handler->setAddress($_POST["address"]);
        
        $repo = new UserRepository($this->conn);
        $repo->register($handler, $_POST["role"]);
    }
}

$handler = new RegisterHandler($conn);
$handler->register();