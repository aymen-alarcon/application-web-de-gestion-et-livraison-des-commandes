<?php
    namespace App\Controller;
    use App\Database\DatabaseConnection;
    use App\Models\Role;

    $db = new DatabaseConnection();
    $conn = $db->connect();

    class RoleController{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function Read(){
            $handler = new Role($this->conn);
            $handler->setUser_id($_GET["id"]);
            $handler->readRole();
        }

        function create(){
            if (!isset($_GET["id"]) || !isset($_GET["name"])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            $handler = new Role($this->conn);
            $handler->setUser_id($_GET["id"]);
            $handler->setName($_GET["name"]);
            
            $handler->registerRole();
        }

        function update(){
            if (!isset($_POST["role_name"]) || !isset($_POST["user_id"])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            $handler = new Role($this->conn);
            $handler->setUser_id($_POST["user_id"]);
            $handler->setName($_POST["role_name"]);

            $handler->update();

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
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

            $handler = new Role($this->conn);
            $handler->setId($id);
            $handler->delete();

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }
    }
?>