<?php

require_once "../Entity/commandeItem.php";
require_once "../Repositories/CommandeItemRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class InsertCommandeItemHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function insertCommandeItem(){
        if (!isset($_POST['product']) || !isset($_POST['quantity']) || !isset($_POST['price'])) {
            return;
        }

        $commandeItemRepo = new CommandeItemRepository($this->conn);

        foreach ($_POST['product'] as $index => $name) {
            $item = new CommandeItem();
            $item->setName($name);
            $item->setQuantity($_POST['quantity'][$index]);
            $item->setPrice($_POST['price'][$index]);
            $item->setCommandeId($_POST["commande_id"]);
            $commandeItemRepo->create($item);
        }
    }
}

$commandeItemClass = new InsertCommandeItemHandler($conn);
$commandeItemClass->insertCommandeItem();