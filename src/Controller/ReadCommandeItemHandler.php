<?php 
require_once "../Entity/CommandeItem.php";
require_once "../Repositories/CommandeItemRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class ReadCommandeItemHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function read(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $commande = new CommandeItem();
            $commande->setCommandeId($_GET["commande_id"]);
            $repo = new CommandeItemRepository($this->conn);
            $repo->read($commande);
        }
    }
}

$read = new ReadCommandeItemHandler($conn);
$read->read();