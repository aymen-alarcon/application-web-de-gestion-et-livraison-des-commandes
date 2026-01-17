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
                $repo->read();
                header("Location: ../../public/client/client_order_dashboard.php");
            }
        }
    }

    $read = new ReadCommandHandler($conn);
    $read->read();