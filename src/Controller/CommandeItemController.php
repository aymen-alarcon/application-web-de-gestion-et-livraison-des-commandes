<?php
    namespace App\Controller;

    use App\Models\CommandeItem;
    use App\Models\Offer;

    class CommandeItemController{
        protected $conn;

        function __construct($conn)
        {
            $this->conn = $conn;
        }

        function create(){
            foreach ($_POST['product'] as $index => $name) {
                if (!isset($_POST['quantity'][$index]) || !isset($_POST['price'][$index]) || !isset($_POST["description"][$index]) || !isset($_POST["commande_id"])) {
                    $_SESSION["flash"] = "one of the inputs is empty";
                    $link = explode("/", $_SERVER["HTTP_REFERER"]);
                    header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                    exit;
                }
                $handler = new CommandeItem($this->conn);
                $handler->setName($name);
                $handler->setQuantity($_POST['quantity'][$index]);
                $handler->setPrice($_POST['price'][$index]);
                $handler->setDescription($_POST["description"][$index]);
                $handler->setCommandeId($_POST["commande_id"]);
                $handler->create();
            }
        }

        function read(){
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                $commandeId = $_GET["commande_id"];

                $orderHandler = new CommandeItem($this->conn);
                $orderHandler->setCommandeId($commandeId);

                $orderHandler->read();

                if (array_search("client", explode("/", $_SERVER["HTTP_REFERER"]))) {                
                    $OfferHandler = new Offer($this->conn);
                    $OfferHandler->setCommande_id($commandeId);
    
                    $OfferHandler->read();
                    header("Location: ../../public/client/client_order.php");
                    exit;
                }else if (array_search("deliverer", explode("/", $_SERVER["HTTP_REFERER"]))) {
                    header("Location: ../../public/deliverer/deliverer_order_interaction.php");
                    exit;
                }
            }
        }

        function update(){
            foreach ($_POST["product"] as $index => $value) {
                if (!isset($_POST["price"][$index]) || !isset($_POST["quantity"][$index]) || !isset($_POST["description"][$index])) {
                    $_SESSION["flash"] = "one of the inputs is empty";
                    $link = explode("/", $_SERVER["HTTP_REFERER"]);
                    header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
                    exit;
                }
                $handler = new CommandeItem($this->conn);
                $handler->setId($_POST["id"][$index]);
                $handler->setName($value);
                $handler->setPrice($_POST["price"][$index]);
                $handler->setQuantity($_POST["quantity"][$index]);
                $handler->setDescription($_POST["description"][$index]);
                $handler->update();
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

            $handler = new CommandeItem($this->conn);
            $handler->setId($id);
            $handler->delete();

            $link = explode("/", $_SERVER["HTTP_REFERER"]);
            header("Location: ../../" . $link[4] . "/" . $link[5] . "/" . $link[6]);
            exit;
        }
    }
?>