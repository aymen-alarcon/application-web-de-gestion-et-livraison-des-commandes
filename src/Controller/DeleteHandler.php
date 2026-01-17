<?php
namespace App\Controller;
use App\Database\DatabaseConnection;
// use App\Models\. $_GET["entityClass"];

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
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            if (!isset($_GET['id'])) {
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            $id = $_GET['id'];

            $entity = new $entityClass($this->conn);
            $entity->setId($id);
            $entity->delete();

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }

    }

    $delete = new DeleteHandler($conn);
    $delete->deleteEntityById($entityClass, $repositoryClass);