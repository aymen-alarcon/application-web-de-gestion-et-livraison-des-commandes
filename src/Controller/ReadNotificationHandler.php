<?php 
    namespace App\Controller;
    use App\Database\DatabaseConnection;
    use App\Models\Notification;

    $db = new DatabaseConnection;
    $conn = $db->connect();

    class ReadNotificationHandler{
        protected $conn;

        function __construct($conn){
            $this->conn = $conn;
        }

        function readNotification(){
            session_start();
            $handler = new Notification($this->conn);
            
            $handler->setReceiverId($_SESSION["id"]);
            $handler->read();

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }
    }

    $classHandler = new ReadNotificationHandler($conn);
    $classHandler->readNotification();