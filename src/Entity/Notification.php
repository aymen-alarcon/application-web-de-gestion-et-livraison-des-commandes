<?php
    class Notification{
        protected $id;
        protected $contenu;
        protected $statu;
        protected $sender_id;
        protected $receiver_id;
        protected $commande;

        function __construct($id = NULL, $contenu = "A new Offer have been sent", $statu = "Not Seen" ,$sender_id = NULL, $receiver_id = NULL, $commande = NULL)
        {
            $this->id = $id;
            $this->contenu = $contenu;
            $this->statu = $statu;
            $this->sender_id = $sender_id;
            $this->receiver_id = $receiver_id;
            $this->commande = $commande;
        }

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getContenu()
        {
                return $this->contenu;
        }

        public function setContenu($contenu)
        {
                $this->contenu = $contenu;
        }

        public function getStatu()
        {
                return $this->statu;
        }

        public function setStatu($statu)
        {
                $this->statu = $statu;
        }

        public function getSender_id()
        {
                return $this->sender_id;
        }

        public function setSender_id($sender_id)
        {
                $this->sender_id = $sender_id;
        }

        public function setReceiverId($receiver_id){
                $this->receiver_id = $receiver_id;
        }

        public function getReceiverId(){
                return $this->receiver_id;
        }

        public function getReceiver_id()
        {
                return $this->commande->getUser_id();
        }
    }
?>