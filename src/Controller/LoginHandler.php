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
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                header("Location: ../../public/index.php");
            }

            $handler = new User();
            $handler->setEmail($_POST["email"]);
            $handler->setPassword($_POST["password"]);
                
            $repo = new UserRepository($this->conn);
            $repo->login($handler);
        }
    }

    $handler = new LoginHandler($conn);
    $handler->login();