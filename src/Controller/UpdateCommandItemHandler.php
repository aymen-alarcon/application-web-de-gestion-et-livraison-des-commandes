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
            $item = new CommandeItem();
            $item->setId($_POST["id"][$index]);
            $item->setName($value);
            $item->setPrice($_POST["price"][$index]);
            $item->setQuantity($_POST["quantity"][$index]);
            $item->setDescription($_POST["description"][$index]);
            $repo->update($item);
        }
    }
}

$updateCommandeHandler = new UpdateCommandItemHandler($conn);
$updateCommandeHandler->updateCommandeItem();