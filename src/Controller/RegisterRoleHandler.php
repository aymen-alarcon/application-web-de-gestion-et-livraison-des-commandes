<?php
    namespace App\Controller;
    use App\Database\DatabaseConnection;
    use App\Models\Role;

    $db = new DatabaseConnection();
    $conn = $db->connect();

    class RegisterRoleHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function RegisterRole(){
            if (!isset($_GET["id"]) || !isset($_GET["name"])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            $handler = new Role($this->conn);
            $handler->setUser_id($_GET["id"]);
            $handler->setName($_GET["name"]);
            
            $handler->registerRole();
        }
    }

    $register = new RegisterRoleHandler($conn);
    $register->RegisterRole();