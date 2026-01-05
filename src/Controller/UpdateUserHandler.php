<?php
require_once "../Entity/User.php";
require_once "../Services/UserRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection;
$conn = $db->connect();

class UpdateUserHandler{
    protected $conn;
    
    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function updateUser(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: ../../public/client/client_profile.php");
            exit;
        }
        $handler = new User();
        $handler->setUsername($_POST["username"]);
        $handler->setFirstName($_POST["first_name"]);
        $handler->setLastName($_POST["last_name"]);
        $handler->setAddress($_POST["address"]);
        $handler->setPhone($_POST["phone"]);
        $handler->setId($_POST["id"]);
        $repo = new UserRepository($this->conn);
        $repo->Update($handler);
        header("Location: ../../public/client/client_profile.php");
        exit;
    }
}

$classHandler = new UpdateUserHandler($conn);
$classHandler->updateUser();