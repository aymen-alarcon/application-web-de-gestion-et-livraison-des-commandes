<?php
namespace App\Controller;
use App\Database\DatabaseConnection;
use App\Models\Commande;

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

            $handler = new Commande($this->conn);
            $handler->setTitre($_POST["titre"]);
            $handler->setAddress($_POST["address"]);
            $handler->setPhone($_POST["phone"]);
            $handler->setUser_id($_SESSION["id"]);
            $handler->create();
        }
    }

    $handler = new InsertCommandeHandler($conn);
    $handler->insertCommande();