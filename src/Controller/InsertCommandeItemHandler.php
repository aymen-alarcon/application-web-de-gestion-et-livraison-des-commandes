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
                $handler = new CommandeItem();
                $handler->setName($name);
                $handler->setQuantity($_POST['quantity'][$index]);
                $handler->setPrice($_POST['price'][$index]);
                $handler->setDescription($_POST["description"][$index]);
                $handler->setCommandeId($_POST["commande_id"]);
                $repo->create($handler);
            }
        }
    }

    $commandeItemClass = new InsertCommandeItemHandler($conn);
    $commandeItemClass->insertCommandeItem();