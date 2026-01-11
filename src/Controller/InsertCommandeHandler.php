<?php
    require_once "../Entity/commande.php";
    require_once "../Repositories/CommandeRepository.php";
    require_once "../Database/DatabaseConnection.php";

    $db = new DatabaseConnection();
    $conn = $db->connect();
    session_start();
    class InsertCommandeHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function insertCommande(){

            if (!isset($_POST["titre"]) || !isset($_POST['address']) || !isset($_POST['phone']) || !isset($_SESSION["id"])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                header("Location: ../../public/client/client_dashboard.php");
            }

            $handler = new Commande();
            $handler->setTitre($_POST["titre"]);
            $handler->setAddress($_POST["address"]);
            $handler->setPhone($_POST["phone"]);
            $handler->setUser_id($_SESSION["id"]);
            $repo = new CommandeRepository($this->conn);
            $repo->create($handler);
        }
    }

    $handler = new InsertCommandeHandler($conn);
    $handler->insertCommande();