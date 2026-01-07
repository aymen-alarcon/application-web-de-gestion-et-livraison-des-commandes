<?php 
require_once "../Services/CommandeRepository.php";
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
            $commandes = $repo->read();
            header("Location: ../../public/client/client_order_dashboard.php");
        }
    }
}

$read = new ReadCommandHandler($conn);
$read->read();