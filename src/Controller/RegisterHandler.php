<?php
require_once "../Entity/User.php";
require_once "../Services/UserRepository.php";
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

        $user = new User();
        
        $user->setUsername($_POST["username"]);
        $user->setFirstName($_POST["first_name"]);
        $user->setLastName($_POST["last_name"]);
        $user->setPhone($_POST["phone"]);
        $user->setPassword($_POST["password"]);
        $user->setEmail($_POST["email"]);
        $user->setAddress($_POST["address"]);
        
        $repo = new UserRepository($this->conn);
        $repo->register($user, $_POST["role"]);
    }
}

$handler = new RegisterHandler($conn);
$handler->register();