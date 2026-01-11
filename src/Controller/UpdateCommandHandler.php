<?php
    require_once "../Entity/commande.php";
    require_once "../Entity/Notification.php";
    require_once "../Entity/Offer.php";
    require_once "../Repositories/NotificationRepository.php";
    require_once "../Repositories/CommandeRepository.php";
    require_once "../Repositories/OfferRepository.php";
    require_once "../Database/DatabaseConnection.php";

    $db = new DatabaseConnection();
    $conn = $db->connect();

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class UpdateCommandHandler{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function updateCommande(){
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

                $repo = new CommandeRepository($this->conn);
                $repo->update($handler);
                $link = explode("/", $_SERVER["HTTP_REFERER"]);
                header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                exit;
            }
            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                if ($_GET["statu"] == "In Progress") {
                    $offerId = (int) $_GET["offerId"];
                    $offerArray = array_filter($_SESSION["offers"], fn($value) => $value["id"] === $offerId);
                    $offerArrayIndex =  array_key_last($offerArray);

                    $offer = new Offer();
                    $offer->setId($offerId);
                    $offer->setStatu("accepted");

                    $repo = new OfferRepository($this->conn);
                    $repo->update($offer);

                    $notification = new Notification();
                    $notification->setContenu("Your Offer with the ID " . $_GET['offerId'] . " has been accepted");
                    $notification->setSender_id($_SESSION["id"]);
                    $notification->setReceiverId($offerArray[$offerArrayIndex]["sender_id"]);

                    $notificationRepo = new NotificationRepository($this->conn);
                    $notificationRepo->create($notification);
                }else if(isset($_GET["offerId"]) && $_GET["statu"] == "Canceled"){
                    $offerId = (int) $_GET["offerId"];
                    $offerArray = array_filter($_SESSION["offers"], fn($value) => $value["id"] === $offerId);
                    $offerArrayIndex =  array_key_last($offerArray);

                    $offer = new Offer();
                    $offer->setId($offerId);
                    $offer->setStatu("refused");

                    $repo = new OfferRepository($this->conn);
                    $repo->update($offer);

                    $notification = new Notification();
                    $notification->setContenu("Your Offer with the ID " . $_GET['offerId'] . " has been refused");
                    $notification->setSender_id($_SESSION["id"]);
                    $notification->setReceiverId($offerArray[$offerArrayIndex]["sender_id"]);

                    $notificationRepo = new NotificationRepository($this->conn);
                    $notificationRepo->create($notification);
                }elseif ($_GET["statu"] == "Completed") {
                    $offerId = (int) $_GET["offerId"];
                    $offerArray = array_filter($_SESSION["offers"], fn($value) => $value["id"] === $offerId);
                    $offerArrayIndex =  array_key_last($offerArray);

                    $offer = new Offer();
                    $offer->setId($offerId);
                    $offer->setStatu("Completed");

                    $repo = new OfferRepository($this->conn);
                    $repo->update($offer);

                    $notification = new Notification();
                    $notification->setContenu("Congratulation, Your Offer with the ID " . $_GET['offerId'] . " has been declared Completed");
                    $notification->setSender_id($_SESSION["id"]);
                    $notification->setReceiverId($offerArray[$offerArrayIndex]["sender_id"]);
                    $notificationRepo = new NotificationRepository($this->conn);
                    $notificationRepo->create($notification);
                }
                $handler->setId($_GET["id"]);
                $handler->setStatu($_GET["statu"]);

                $repo = new CommandeRepository($this->conn);
                $repo->update($handler);
                header("Location: ../../public/client/client_order_dashboard.php");
                exit;
            }
        }
    }

    $updateCommandeHandler = new UpdateCommandHandler($conn);
    $updateCommandeHandler->updateCommande();