<?php
require_once "../Entity/Role.php";
require_once "../Repositories/RoleRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class ReadRoleHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function ReadRole(){
        $role = new Role();
        $role->setUser_id($_GET["id"]);
        $repo = new RoleRepository($this->conn);
        $repo->readRole($role);
    }
}

$register = new ReadRoleHandler($conn);
$register->ReadRole();