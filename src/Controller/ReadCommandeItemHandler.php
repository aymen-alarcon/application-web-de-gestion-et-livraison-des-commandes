<?php 
namespace App\Controller;
use App\Database\DatabaseConnection;
use App\Models\Offer;
use App\Models\CommandeItem;
    $db = new DatabaseConnection();
    $conn = $db->connect();

    class ReadCommandeItemHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function read(){
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                $commandeId = $_GET["commande_id"];

                $orderHandler = new CommandeItem($this->conn);
                $orderHandler->setCommandeId($commandeId);

                $orderHandler->read();

                if (array_search("client", explode("/", $_SERVER["HTTP_REFERER"]))) {                
                    $OfferHandler = new Offer($this->conn);
                    $OfferHandler->setCommande_id($commandeId);
    
                    $OfferHandler->read();
                    header("Location: ../../public/client/client_order.php");
                    exit;
                }else if (array_search("deliverer", explode("/", $_SERVER["HTTP_REFERER"]))) {
                    header("Location: ../../public/deliverer/deliverer_order_interaction.php");
                    exit;
                }
            }
        }
    }

    $read = new ReadCommandeItemHandler($conn);
    $read->read();