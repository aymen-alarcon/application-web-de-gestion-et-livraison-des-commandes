<?php
    require_once "../Entity/Commande.php";
    require_once "../Entity/Notification.php";
    require_once "../Services/NotificationRepository.php";
    require_once "../Database/DatabaseConnection.php";

    $db = new DatabaseConnection;
    $conn = $db->connect();

    class CreateNotificationHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function createNotification(){
            $commande = new Commande();
            $commande->setUser_id($_GET["commande_id"]);
            $handler = new Notification(NULL, "A new Offer have been sent", "Not Seen" , NULL, NULL, $commande);
            $repo = new NotificationRepository($this->conn);
            $repo->create($handler);
            header("Location: ../../public/deliverer/deliverer_orders.php");
            exit;
        }
    }

    $classHandler = new CreateNotificationHandler($conn);
    $classHandler->createNotification();
?>