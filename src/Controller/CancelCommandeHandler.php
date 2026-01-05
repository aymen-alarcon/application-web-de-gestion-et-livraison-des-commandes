<?php
require_once "../Entity/Commande.php";
require_once "../Services/CommandeRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class CancelCommandeHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function cancelCommande(){
        $commande = new Commande();
        $commande->setId($_GET["id"]);
        $commande->setStatu("Canceled");
        $repo = new CommandeRepository($this->conn);
        $repo->cancel($commande);
    }
}

$className = new CancelCommandeHandler($conn);
$className->cancelCommande();