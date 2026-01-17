<?php
    namespace App\Controller;
    use App\Database\DatabaseConnection;
    use App\Models\CommandeItem;

    $db = new DatabaseConnection();
    $conn = $db->connect();

    class InsertCommandeItemHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function insertCommandeItem(){
            foreach ($_POST['product'] as $index => $name) {
                if (!isset($_POST['quantity'][$index]) || !isset($_POST['price'][$index]) || !isset($_POST["description"][$index]) || !isset($_POST["commande_id"])) {
                    $_SESSION["flash"] = "one of the inputs is empty";
                    $link = explode("/", $_SERVER["HTTP_REFERER"]);
                    header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                    exit;
                }
                $handler = new CommandeItem($this->conn);
                $handler->setName($name);
                $handler->setQuantity($_POST['quantity'][$index]);
                $handler->setPrice($_POST['price'][$index]);
                $handler->setDescription($_POST["description"][$index]);
                $handler->setCommandeId($_POST["commande_id"]);
                $handler->create();
            }
        }
    }

    $commandeItemClass = new InsertCommandeItemHandler($conn);
    $commandeItemClass->insertCommandeItem();