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
            if (!isset($_POST['username']) || !isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['address']) || !isset($_POST['phone']) || !isset($_POST['password'])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }
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