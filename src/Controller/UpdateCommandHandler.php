<?php
require_once "../Entity/commande.php";
require_once "../Entity/Notification.php";
require_once "../Entity/Offer.php";
require_once "../Services/NotificationRepository.php";
require_once "../Services/CommandeRepository.php";
require_once "../Services/OfferRepository.php";
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
        $handler = new Commande();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $handler->setId($_POST["id"]);
            $handler->setTitre($_POST["titre"]);
            $handler->setAddress($_POST["address"]);
            $handler->setPhone($_POST["phone"]);
        }

        $offerId = (int) $_GET["offerId"];
        $offerArray = array_filter($_SESSION["offers"], fn($value) => $value["id"] === $offerId);
        $offerArrayIndex =  array_key_last($offerArray);

        if ($_GET["statu"] == "In Progress") {
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
        }else{
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
        }
        $handler->setId($_GET["id"]);
        $handler->setStatu($_GET["statu"]);
        $repo = new CommandeRepository($this->conn);
        $repo->update($handler);
        header("Location: ../../public/client/client_order_dashboard.php");
        exit;
    }
}

$updateCommandeHandler = new UpdateCommandHandler($conn);
$updateCommandeHandler->updateCommande();