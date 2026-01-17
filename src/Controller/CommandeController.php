<?php
    namespace App\Controller;

    use App\Models\Commande;
    use App\Models\Offer;
    use App\Models\Notification;

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
            if (!isset($_POST["titre"]) || !isset($_POST["address"]) || !isset($_POST["phone"]) || !isset($_POST["statuss"])) {
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
                $handler->setStatus($_POST["status"]);

                $handler->update();
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }
            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                if ($_GET["status"] == "In Progress") {
                    $offerId = (int) $_GET["offerId"];
                    $offerArray = array_filter($_SESSION["offers"], fn($value) => $value["id"] === $offerId);
                    $offerArrayIndex =  array_key_last($offerArray);

                    $offerHandler = new Offer();
                    $offerHandler->setId($offerId);
                    $offerHandler->setStatus("accepted");

                    $offerHandler->update();

                    $NotificationHandler = new Notification($this->conn);
                    $NotificationHandler->setContenu("Your Offer with the ID " . $_GET['offerId'] . " has been accepted");
                    $NotificationHandler->setSender_id($_SESSION["id"]);
                    $NotificationHandler->setReceiverId($offerArray[$offerArrayIndex]["sender_id"]);

                    $NotificationHandler->create();
                }else if(isset($_GET["offerId"]) && $_GET["status"] == "Canceled"){
                    $offerId = (int) $_GET["offerId"];
                    $offerArray = array_filter($_SESSION["offers"], fn($value) => $value["id"] === $offerId);
                    $offerArrayIndex =  array_key_last($offerArray);

                    $offerHandler = new Offer($this->conn);
                    $offerHandler->setId($offerId);
                    $offerHandler->setStatus("refused");

                    $offerHandler->update();

                    $NotificationHandler = new Notification($this->conn);
                    $NotificationHandler->setContenu("Your Offer with the ID " . $_GET['offerId'] . " has been refused");
                    $NotificationHandler->setSender_id($_SESSION["id"]);
                    $NotificationHandler->setReceiverId($offerArray[$offerArrayIndex]["sender_id"]);

                    $NotificationHandler->create();
                }elseif ($_GET["status"] == "Completed") {
                    $offerId = (int) $_GET["offerId"];
                    $offerArray = array_filter($_SESSION["offers"], fn($value) => $value["id"] === $offerId);
                    $offerArrayIndex =  array_key_last($offerArray);

                    $offerHandler = new Offer($this->conn);
                    $offerHandler->setId($offerId);
                    $offerHandler->setStatus("Completed");

                    $offerHandler->update();

                    $NotificationHandler = new Notification($this->conn);
                    $NotificationHandler->setContenu("Congratulation, Your Offer with the ID " . $_GET['offerId'] . " has been declared Completed");
                    $NotificationHandler->setSender_id($_SESSION["id"]);
                    $NotificationHandler->setReceiverId($offerArray[$offerArrayIndex]["sender_id"]);
                    $NotificationHandler->create();
                }
                $handler->setId($_GET["id"]);
                $handler->setStatus($_GET["status"]);

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