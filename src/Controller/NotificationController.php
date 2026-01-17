<?php
    namespace App\Controller;
    
    use App\Models\Notification;

    class NotificationController{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function create(){
            $handler = new Notification($this->conn);
            foreach ($_SESSION['commandes'] as $order) {
                if ($order["id"] == $_GET["commande_id"]) {
                    $handler->setReceiverId($order["user_id"]);
                }
            }
            $handler->create();
            header("Location: ../../public/deliverer/deliverer_orders.php");
            exit;
        }

        function read(){
            session_start();
            $handler = new Notification($this->conn);
            
            $handler->setReceiverId($_SESSION["id"]);
            $handler->read();

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }

        function delete() {
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

            $handler = new Notification($this->conn);
            $handler->setId($id);
            $handler->delete();

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }
    }
?>