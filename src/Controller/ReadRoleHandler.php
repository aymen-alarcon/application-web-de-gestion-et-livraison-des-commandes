<?php
    namespace App\Controller;
    use App\Database\DatabaseConnection;
    use App\Models\Role;

    $db = new DatabaseConnection();
    $conn = $db->connect();

    class ReadRoleHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function ReadRole(){
            $handler = new Role($this->conn);
            $handler->setUser_id($_GET["id"]);
            $handler->readRole();
        }
    }

    $register = new ReadRoleHandler($conn);
    $register->ReadRole();