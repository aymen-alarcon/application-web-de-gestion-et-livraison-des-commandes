<?php
require_once "../Entity/User.php";
require_once "../Repositories/UserRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class LoginHandler {
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new User();
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);

            $repo = new UserRepository($this->conn);
            $repo->login($user);
        }
    }
}

$handler = new LoginHandler($conn);
$handler->login();