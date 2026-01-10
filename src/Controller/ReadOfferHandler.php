<?php
    require_once "../Entity/Offer.php";
    require_once "../Repositories/OfferRepository.php";
    require_once "../Database/DatabaseConnection.php";

    $db = new DatabaseConnection();
    $conn = $db->connect();

    session_start();
    
    class ReadOfferHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function ReadOffer(){
            $handler = new Offer();
            $handler->setId($_GET["offerId"]);
            $repo = new OfferRepository($this->conn);
            $repo->read($handler);
            header("Location: ../../public/client/client_order_dashboard.php");
        }
    }

    $register = new ReadOfferHandler($conn);
    $register->ReadOffer();