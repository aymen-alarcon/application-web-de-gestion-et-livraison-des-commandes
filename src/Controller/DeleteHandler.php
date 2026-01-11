<?php
    $entityClass = $_GET["entityClass"];
    $repositoryClass = $_GET["entityClass"] . "Repository";

    require_once "../Entity/". $entityClass .".php";
    require_once "../Repositories/". $repositoryClass .".php";
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

            $entity = new $entityClass();
            $entity->setId($id);

            $repo = new $repositoryClass($this->conn);
            $repo->delete($entity);

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }

    }

    $delete = new DeleteHandler($conn);
    $delete->deleteEntityById($entityClass, $repositoryClass);