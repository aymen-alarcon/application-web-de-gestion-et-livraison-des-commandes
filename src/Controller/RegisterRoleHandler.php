<?php
require_once "../Entity/Role.php";
require_once "../Services/RoleRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class RegisterRoleHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function RegisterRole(){
        $handler = new Role();
        $handler->setUser_id($_GET["id"]);
        $handler->setName($_GET["name"]);
        $repo = new RoleRepository($this->conn);
        $repo->registerRole($handler);
    }
}

$register = new RegisterRoleHandler($conn);
$register->RegisterRole();