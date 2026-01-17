<?php
    namespace App\Controller;
    use App\Models\Notification;

    session_start();

    class CreateNotificationHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function createNotification(){
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
    }

    $classHandler = new CreateNotificationHandler($conn);
    $classHandler->createNotification();
?>