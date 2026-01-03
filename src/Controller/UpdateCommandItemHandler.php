<?php

require_once "../Entity/commandeItem.php";
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
        $newCommande = new CommandeItem();
        $newCommande->setName($_POST["name"]);
        $newCommande->setPrice($_POST["price"]);
        $newCommande->setQuantity($_POST["quantity"]);
        $updateCommande = new CommandeRepository($this->conn);
        $updateCommande->update($newCommande);
    }
}

$updateCommandeHandler = new UpdateCommandHandler($conn);
$updateCommandeHandler->updateCommande();