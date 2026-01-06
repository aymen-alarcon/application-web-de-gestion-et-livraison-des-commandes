<?php
    class Offer{
        protected $id;
        protected $vehicule;
        protected $price;
        protected $duree;
        protected $commande_id;
    
        function __construct($id = NULL, $vehicule = NULL, $price = NULL, $duree = NULL, $commande_id = NULL)
        {
            $this->id = $id;
            $this->vehicule = $vehicule;
            $this->price = $price;
            $this->duree = $duree;
            $this->commande_id = $commande_id;
        }

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getVehicule()
        {
                return $this->vehicule;
        }

        public function setVehicule($vehicule)
        {
                $this->vehicule = $vehicule;
        }

        public function getPrice()
        {
                return $this->price;
        }

        public function setPrice($price)
        {
                $this->price = $price;
        }

        public function getDuree()
        {
                return $this->duree;
        }

        public function setDuree($duree)
        {
                $this->duree = $duree;
        }

        public function getCommande_id()
        {
                return $this->commande_id;
        }

        public function setCommande_id($commande_id)
        {
                $this->commande_id = $commande_id;
        }
    }
?>