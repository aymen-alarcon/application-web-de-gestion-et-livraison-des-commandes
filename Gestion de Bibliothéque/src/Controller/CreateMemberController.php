<?php
namespace App\Controller;

use App\Models\User;
use App\Config\DatabaseConnection;
use App\Models\Membre;
use PDO;

$db = new DatabaseConnection();
$conn = $db->establishConnection();

class CreateMemberController{
    private PDO $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function createMember(){
        $handler = new User();
        $handler->setFirstName($_POST["first_name"]);
        $handler->setLastName($_POST["last_name"]);
        $handler->setEmail($_POST["email"]);
        $handler->setPassword($_POST["password"]);
        $repo = new Membre();
        $repo->create();
    }
}

$classHandler = new CreateMemberController($conn);
$classHandler->createMember();