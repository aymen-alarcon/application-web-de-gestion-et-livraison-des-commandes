<?php
require_once "../Entity/commande.php";
require_once "../Repositories/CommandeRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class DeleteCommandHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function deleteCommande(){
        if ($_SERVER["REQUEST_METHOD"] !== "GET") {
            header("Location: ../../public/client_order_dashboard.php");
        }
        $commandeItme = new Commande();
        $commandeItme->setId($_GET["id"]);
        $commande = new CommandeRepository($this->conn);
        $commande->delete($commandeItme);
    }
}

$delete = new DeleteCommandHandler($conn);
$delete->deleteCommande();