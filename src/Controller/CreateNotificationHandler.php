<?php
    require_once "../Entity/Commande.php";
    require_once "../Entity/Notification.php";
    require_once "../Repositories/NotificationRepository.php";
    require_once "../Database/DatabaseConnection.php";

    $db = new DatabaseConnection;
    $conn = $db->connect();
    session_start();

    class CreateNotificationHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function createNotification(){
            $handler = new Notification();
            foreach ($_SESSION['commandes'] as $order) {
                if ($order["id"] == $_GET["commande_id"]) {
                    $handler->setReceiverId($order["user_id"]);
                }
            }
            $repo = new NotificationRepository($this->conn);
            $repo->create($handler);
            header("Location: ../../public/deliverer/deliverer_orders.php");
            exit;
        }
    }

    $classHandler = new CreateNotificationHandler($conn);
    $classHandler->createNotification();
?>