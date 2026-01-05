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
        $user = new User();
        $user->setUsername($_POST["username"]);
        $user->setFirstName($_POST["first_name"]);
        $user->setLastName($_POST["last_name"]);
        $user->setAddress($_POST["address"]);
        $user->setPhone($_POST["phone"]);
        $user->setId($_POST["id"]);
        var_dump($_POST["username"]);
        var_dump($_POST["first_name"]);
        var_dump($_POST["last_name"]);
        var_dump($_POST["address"]);
        var_dump($_POST["phone"]);
        var_dump($_POST["id"]);
        $repo = new UserRepository($this->conn);
        $repo->Update($user);
        header("Location: ../../public/client/client_profile.php");
        exit;
    }
}

$classHandler = new UpdateUserHandler($conn);
$classHandler->updateUser();