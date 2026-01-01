<?php 

require_once "../Entity/Commande.php";
require_once "../Repositories/CommandeRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();
session_start();

class ReadCommandHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function read(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $repo = new CommandeRepository($this->conn);
            $repo->read();
        }
    }
}

$read = new ReadCommandHandler($conn);
$read->read();