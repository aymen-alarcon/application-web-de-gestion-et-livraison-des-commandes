<?php
namespace App\Controller;
use App\Database\DatabaseConnection;
use App\Models\Offer;
    $db = new DatabaseConnection;
    $conn = $db->connect();
    session_start();

    class CreateOfferHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function createOffer(){
            if (!isset($_POST["price"]) || !isset($_POST["vehicle"]) || !isset($_POST["duree"]) || !isset($_POST["commande_id"]) || !isset($_SESSION["id"])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            $handler = new Offer($this->conn);
            $handler->setPrice($_POST["price"]);
            $handler->setVehicule($_POST["vehicle"]);
            $handler->setDuree($_POST["duree"]);
            $handler->setCommande_id($_POST["commande_id"]);
            $handler->setSender_id($_SESSION["id"]);

            $handler->create();
        }
    }

    $classHandler = new CreateOfferHandler($conn);
    $classHandler->createOffer();
?>