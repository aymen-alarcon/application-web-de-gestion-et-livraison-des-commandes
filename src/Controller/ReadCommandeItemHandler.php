<?php 
require_once "../Entity/CommandeItem.php";
require_once "../Services/CommandeItemRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class ReadCommandeItemHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function read(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $handler = new CommandeItem();
            $handler->setCommandeId($_GET["commande_id"]);
            $repo = new CommandeItemRepository($this->conn);
            $repo->read($handler);

            var_dump($_SERVER["HTTP_REFERER"]);
            if (array_search("client", explode("/", $_SERVER["HTTP_REFERER"]))) {                
                header("Location: ../../public/client/client_order.php");
                exit;
            }else if (array_search("deliverer", explode("/", $_SERVER["HTTP_REFERER"]))) {
                header("Location: ../../public/deliverer/deliverer_order_interaction.php");
                exit;
            }
        }

    }
}

$read = new ReadCommandeItemHandler($conn);
$read->read();