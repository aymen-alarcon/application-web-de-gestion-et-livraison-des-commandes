<?php
namespace App\Controller;
use App\Database\DatabaseConnection;
use App\Models\Offer;
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
            $handler = new Offer($this->conn);
            $handler->setId($_GET["offerId"]);
            $handler->read();
            header("Location: ../../public/client/client_order_dashboard.php");
        }
    }

    $register = new ReadOfferHandler($conn);
    $register->ReadOffer();