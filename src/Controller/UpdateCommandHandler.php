<?php

require_once "../Entity/commande.php";
require_once "../Repositories/CommandeRepository.php";
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
        $newCommande = new Commande();
        $newCommande->setId($_POST["id"]);
        $newCommande->setTitre($_POST["titre"]);
        $newCommande->setAddress($_POST["address"]);
        $newCommande->setPhone($_POST["phone"]);
        $updateCommande = new CommandeRepository($this->conn);
        $updateCommande->update($newCommande);
    }
}

$updateCommandeHandler = new UpdateCommandHandler($conn);
$updateCommandeHandler->updateCommande();