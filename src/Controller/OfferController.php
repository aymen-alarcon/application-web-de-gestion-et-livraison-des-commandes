<?php
    namespace App\Controller;
    use App\Database\DatabaseConnection;
    use App\Models\Offer;

    $db = new DatabaseConnection;
    $conn = $db->connect();
    session_start();

    class OfferController{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function create(){
            if (!isset($_POST["price"]) || !isset($_POST["vehicle"]) || !isset($_POST["duree"]) || !isset($_POST["commande_id"]) || !isset($_SESSION["id"])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            $handler = new Offer($this->conn);
            $handler->setPrice($_POST["price"]);
            $handler->setVehicule($_POST["vehicle"]);
            $handler->setDuree($_POST["duree"]);
            $handler->setCommande_id($_POST["commande_id"]);
            $handler->setSender_id($_SESSION["id"]);

            $handler->create();
        }

        function Read(){
            $handler = new Offer($this->conn);
            $handler->setId($_GET["offerId"]);
            $handler->read();
            header("Location: ../../public/client/client_order_dashboard.php");
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

            $handler = new Offer($this->conn);
            $handler->setId($id);
            $handler->delete();

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }
    }
?>