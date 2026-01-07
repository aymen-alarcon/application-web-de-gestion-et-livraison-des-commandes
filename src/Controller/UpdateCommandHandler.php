<?php

require_once "../Entity/commande.php";
require_once "../Services/CommandeRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class UpdateCommandHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function updateCommande(){
        $handler = new Commande();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $handler->setId($_POST["id"]);
            $handler->setTitre($_POST["titre"]);
            $handler->setAddress($_POST["address"]);
            $handler->setPhone($_POST["phone"]);
        }
        if ($_GET["statu"] === "In Progress") {
            $offer = new Offer();
            $offer->setStatu("accepted");
        }
        $handler->setStatu($_GET["statu"]);
        $repo = new CommandeRepository($this->conn);
        $repo->update($handler);
        header("Location: ../../public/client/client_order_dashboard.php");
        exit;
    }
}

$updateCommandeHandler = new UpdateCommandHandler($conn);
$updateCommandeHandler->updateCommande();