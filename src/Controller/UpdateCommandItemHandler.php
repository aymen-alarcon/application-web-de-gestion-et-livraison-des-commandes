<?php
require_once "../Entity/commandeItem.php";
require_once "../Services/CommandeItemRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class UpdateCommandItemHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function updateCommandeItem(){
        $repo = new CommandeItemRepository($this->conn);
        foreach ($_POST["product"] as $index => $value) {
            $handler = new CommandeItem();
            $handler->setId($_POST["id"][$index]);
            $handler->setName($value);
            $handler->setPrice($_POST["price"][$index]);
            $handler->setQuantity($_POST["quantity"][$index]);
            $handler->setDescription($_POST["description"][$index]);
            $repo->update($handler);
        }
    }
}

$updateCommandeHandler = new UpdateCommandItemHandler($conn);
$updateCommandeHandler->updateCommandeItem();