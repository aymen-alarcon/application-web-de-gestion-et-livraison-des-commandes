<?php 
namespace App\Controller;
use App\Database\DatabaseConnection;
use App\Models\Commande;

    $db = new DatabaseConnection();
    $conn = $db->connect();
    session_start();

    class ReadCommandHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function read(){
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                $repo = new Commande($this->conn);
                $repo->readAll();
                header("Location: ../../public/deliverer/deliverer_orders.php");
                exit;
            }
        }
    }

    $read = new ReadCommandHandler($conn);
    $read->read();