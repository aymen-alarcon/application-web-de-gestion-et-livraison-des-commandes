<?php

$entityClass = $_GET["entityClass"];
$repositoryClass = $_GET["repositoryClass"];

require_once "../Entity/". $entityClass .".php";
require_once "../Services/". $repositoryClass .".php";
require_once "../Database/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->connect();

session_start();
class DeleteHandler{
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function deleteEntityById(string $entityClass, string $repositoryClass) {
        if ($_SERVER["REQUEST_METHOD"] !== "GET") {
            header("Location: ../../public/client/client_order_dashboard.php");
            exit;
        }

        if (!isset($_GET['id'])) {
            header("Location: ../../public/client/client_order_dashboard.php");
            exit;
        }

        $id = $_GET['id'];

        $entity = new $entityClass();
        $entity->setId($id);

        $repo = new $repositoryClass($this->conn);
        $repo->delete($entity);

        header("Location: ../../public/client/client_order_dashboard.php");
        exit;
    }

}

$delete = new DeleteHandler($conn);
$delete->deleteEntityById($entityClass, $repositoryClass);