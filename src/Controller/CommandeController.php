<?php
    namespace App\Controller;
    use App\Database\DatabaseConnection;
    use App\Models\Commande;
    use App\Models\Offer;
    use App\Models\Notification;

    $db = new DatabaseConnection();
    $conn = $db->connect();
    session_start();
    class CommandeController{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function create(){
            if (!isset($_POST["titre"]) || !isset($_POST['address']) || !isset($_POST['phone']) || !isset($_SESSION["id"])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                header("Location: ../../public/client/client_dashboard.php");
            }

            $handler = new Commande($this->conn);
            $handler->setTitre($_POST["titre"]);
            $handler->setAddress($_POST["address"]);
            $handler->setPhone($_POST["phone"]);
            $handler->setUser_id($_SESSION["id"]);
            $handler->create();
        }

        function read(){
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                $repo = new Commande($this->conn);
                $repo->readAll();
                header("Location: ../../public/deliverer/deliverer_orders.php");
                exit;
            }
        }

        function update(){
            if (!isset($_POST["titre"]) || !isset($_POST["address"]) || !isset($_POST["phone"]) || !isset($_POST["statu"])) {
                $_SESSION["flash"] = "one of the inputs is empty";
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }
        
            $handler = new Commande();

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $handler->setId($_POST["id"]);
                $handler->setTitre($_POST["titre"]);
                $handler->setAddress($_POST["address"]);
                $handler->setPhone($_POST["phone"]);
                $handler->setStatu($_POST["statu"]);

                $handler->update();
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }
            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                if ($_GET["statu"] == "In Progress") {
                    $offerId = (int) $_GET["offerId"];
                    $offerArray = array_filter($_SESSION["offers"], fn($value) => $value["id"] === $offerId);
                    $offerArrayIndex =  array_key_last($offerArray);

                    $offerHandler = new Offer();
                    $offerHandler->setId($offerId);
                    $offerHandler->setStatu("accepted");

                    $offerHandler->update();

                    $NotificationHandler = new Notification($this->conn);
                    $NotificationHandler->setContenu("Your Offer with the ID " . $_GET['offerId'] . " has been accepted");
                    $NotificationHandler->setSender_id($_SESSION["id"]);
                    $NotificationHandler->setReceiverId($offerArray[$offerArrayIndex]["sender_id"]);

                    $NotificationHandler->create();
                }else if(isset($_GET["offerId"]) && $_GET["statu"] == "Canceled"){
                    $offerId = (int) $_GET["offerId"];
                    $offerArray = array_filter($_SESSION["offers"], fn($value) => $value["id"] === $offerId);
                    $offerArrayIndex =  array_key_last($offerArray);

                    $offerHandler = new Offer($this->conn);
                    $offerHandler->setId($offerId);
                    $offerHandler->setStatu("refused");

                    $offerHandler->update();

                    $NotificationHandler = new Notification($this->conn);
                    $NotificationHandler->setContenu("Your Offer with the ID " . $_GET['offerId'] . " has been refused");
                    $NotificationHandler->setSender_id($_SESSION["id"]);
                    $NotificationHandler->setReceiverId($offerArray[$offerArrayIndex]["sender_id"]);

                    $NotificationHandler->create();
                }elseif ($_GET["statu"] == "Completed") {
                    $offerId = (int) $_GET["offerId"];
                    $offerArray = array_filter($_SESSION["offers"], fn($value) => $value["id"] === $offerId);
                    $offerArrayIndex =  array_key_last($offerArray);

                    $offerHandler = new Offer($this->conn);
                    $offerHandler->setId($offerId);
                    $offerHandler->setStatu("Completed");

                    $offerHandler->update();

                    $NotificationHandler = new Notification($this->conn);
                    $NotificationHandler->setContenu("Congratulation, Your Offer with the ID " . $_GET['offerId'] . " has been declared Completed");
                    $NotificationHandler->setSender_id($_SESSION["id"]);
                    $NotificationHandler->setReceiverId($offerArray[$offerArrayIndex]["sender_id"]);
                    $NotificationHandler->create();
                }
                $handler->setId($_GET["id"]);
                $handler->setStatu($_GET["statu"]);

                $handler->update();
                header("Location: ../../public/client/client_order_dashboard.php");
                exit;
            }
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

            $handler = new Commande($this->conn);
            $handler->setId($id);
            $handler->delete();

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }
    }
?>