<?php
    namespace App\Controller;
    use App\Database\DatabaseConnection;
    use App\Models\User;

    $db = new DatabaseConnection;
    $conn = $db->connect();

    session_start();
    
    class UserController{
        protected $conn;
        
        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function update(){
            if (!isset($_POST['username']) || !isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['address']) || !isset($_POST["email"]) || !isset($_POST['phone']) || !isset($_POST['id'])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }
            $handler = new User($this->conn);
            $handler->setUsername($_POST["username"]);
            $handler->setFirstName($_POST["first_name"]);
            $handler->setLastName($_POST["last_name"]);
            $handler->setAddress($_POST["address"]);
            $handler->setEmail($_POST["email"]);
            $handler->setPhone($_POST["phone"]);
            $handler->setId($_POST["id"]);
            $handler->Update();
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

            $handler = new User($this->conn);
            $handler->setId($id);
            $handler->delete();

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }
    }
?>