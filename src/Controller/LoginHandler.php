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
            if (!isset($_POST["email"]) || !isset($_POST["password"])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
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