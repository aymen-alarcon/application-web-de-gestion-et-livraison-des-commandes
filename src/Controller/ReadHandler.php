<?php 

require_once "../Entity/User.php";
require_once "../Repositories/UserRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();
session_start();

class ReadHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

   

    function read(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $userCredentials = new User();
            $userCredentials->setId($_SESSION["id"]); 
            $repo = new UserRepository($this->conn);
            $repo->read($userCredentials);
        }
    }
}

$read = new ReadHandler($conn);
$read->read();