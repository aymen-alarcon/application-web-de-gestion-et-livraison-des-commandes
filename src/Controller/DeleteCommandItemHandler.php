<?php
require_once "../Entity/commandeItem.php";
require_once "../Repositories/CommandeItemRepository.php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

class DeleteCommandHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function deleteCommandeItem(){
        if ($_SERVER["REQUEST_METHOD"] !== "GET") {
            header("Location: ../../public/client_order_dashboard.php");
        }
        $commandeItme = new CommandeItem();
        $commandeItme->setId($_GET["id"]);
        $repo = new CommandeItemRepository($this->conn);
        $repo->delete($commandeItme);
    }
}

$delete = new DeleteCommandHandler($conn);
$delete->deleteCommandeItem();