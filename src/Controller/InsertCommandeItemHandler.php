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
        $repo = new CommandeItemRepository($this->conn);
        foreach ($_POST['product'] as $index => $name) {
            $item = new CommandeItem();
            $item->setName($name);
            $item->setQuantity($_POST['quantity'][$index]);
            $item->setPrice($_POST['price'][$index]);
            $item->setDescription($_POST["description"][$index]);
            $item->setCommandeId($_POST["commande_id"]);
            $repo->create($item);
        }
    }
}

$commandeItemClass = new InsertCommandeItemHandler($conn);
$commandeItemClass->insertCommandeItem();