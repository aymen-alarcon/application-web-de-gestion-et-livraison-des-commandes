<?php
    require_once "../Entity/Role.php";
    require_once "../Repositories/RoleRepository.php";
    require_once "../Database/DatabaseConnection.php";

    $db = new DatabaseConnection;
    $conn = $db->connect();

    session_start();

    class UpdateRoleHandler{
        protected $conn;

        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        function updateRoles(){
            if (!isset($_POST["role_name"]) || !isset($_POST["user_id"])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            $handler = new Role();
            $handler->setUser_id($_POST["user_id"]);
            $handler->setName($_POST["role_name"]);

            $repo = new RoleRepository($this->conn);
            $repo->update($handler);

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
        }
    }

    $HandlerClass = new UpdateRoleHandler($conn);
    $HandlerClass->updateRoles();