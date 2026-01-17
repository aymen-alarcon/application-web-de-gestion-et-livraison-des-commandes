<?php
    namespace App\Controller;
    use App\Database\DatabaseConnection;
    use App\Models\CommandeItem;
    
    $db = new DatabaseConnection();
    $conn = $db->connect();

    class UpdateCommandItemHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function updateCommandeItem(){
            foreach ($_POST["product"] as $index => $value) {
                if (!isset($_POST["price"][$index]) || !isset($_POST["quantity"][$index]) || !isset($_POST["description"][$index])) {
                    $_SESSION["flash"] = "one of the inputs is empty";
                    $link = explode("/", $_SERVER["HTTP_REFERER"]);
                    header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                    exit;
                }
                $handler = new CommandeItem($this->conn);
                $handler->setId($_POST["id"][$index]);
                $handler->setName($value);
                $handler->setPrice($_POST["price"][$index]);
                $handler->setQuantity($_POST["quantity"][$index]);
                $handler->setDescription($_POST["description"][$index]);
                $handler->update();
            }
        }
    }

    $updateCommandeHandler = new UpdateCommandItemHandler($conn);
    $updateCommandeHandler->updateCommandeItem();