<?php
require_once "../Entity/commande.php";
require_once "../Repositories/CommandeRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class InsertCommandeHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function insertCommande(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: ../../public/client_dashboard.php");
        }

        $commande = new Commande();
        $commande->setTitre($_POST["titre"]);
        $commande->setAddress($_POST["address"]);
        $commande->setPhone($_POST["phone"]);

        $repo = new CommandeRepository($this->conn);
        $repo->create($commande);
    }
}

$handler = new InsertCommandeHandler($conn);
$handler->insertCommande();