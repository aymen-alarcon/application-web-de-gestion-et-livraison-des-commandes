<?php 
    require_once "../Database/DatabaseConnection.php";
    require_once "../Entity/Notification.php";
    require_once "../Repositories/NotificationRepository.php";

    $db = new DatabaseConnection;
    $conn = $db->connect();

    class ReadNotificationHandler{
        protected $conn;

        function __construct($conn){
            $this->conn = $conn;
        }

        function readNotification(){
            session_start();
            $handler = new Notification();
            $handler->setReceiverId($_SESSION["id"]);
            $repo = new NotificationRepository($this->conn);
            $repo->read($handler);
            header("Location: ../../public/client/client_dashboard.php");
            exit;
        }
    }

    $classHandler = new ReadNotificationHandler($conn);
    $classHandler->readNotification();