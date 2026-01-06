<?php
    require_once "../Entity/Offer.php";
    require_once "../Services/OfferRepository.php";
    require_once "../Database/DatabaseConnection.php";

    $db = new DatabaseConnection;
    $conn = $db->connect();

    class CreateOfferHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function createOffer(){
            $handler = new Offer();
            $handler->setPrice($_POST["price"]);
            $handler->setVehicule($_POST["vehicle"]);
            $handler->setDuree($_POST["duree"]);
            $handler->setCommande_id($_POST["commande_id"]);
            $repo = new OfferRepository($this->conn);
            $repo->create($handler);
        }
    }

    $classHandler = new CreateOfferHandler($conn);
    $classHandler->createOffer();
?>