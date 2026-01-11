<?php
    require_once "../Entity/User.php";
    require_once "../Repositories/UserRepository.php";
    require_once "../Database/DatabaseConnection.php";

    $db = new DatabaseConnection;
    $conn = $db->connect();

    session_start();
    
    class UpdateUserHandler{
        protected $conn;
        
        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function updateUser(){
            if (!isset($_POST['username']) || !isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['address']) || !isset($_POST["email"]) || !isset($_POST['phone']) || !isset($_POST['id'])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }
            $handler = new User();
            $handler->setUsername($_POST["username"]);
            $handler->setFirstName($_POST["first_name"]);
            $handler->setLastName($_POST["last_name"]);
            $handler->setAddress($_POST["address"]);
            $handler->setEmail($_POST["email"]);
            $handler->setPhone($_POST["phone"]);
            $handler->setId($_POST["id"]);
            $repo = new UserRepository($this->conn);
            $repo->Update($handler);
            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }
    }

    $classHandler = new UpdateUserHandler($conn);
    $classHandler->updateUser();