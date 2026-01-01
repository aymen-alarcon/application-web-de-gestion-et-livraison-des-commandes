<?php

class CommandeItem{
    protected $id;
    protected $name;
    protected $quantity;
    protected $price;
    protected $commande_id;

    function __construct($id = NULL, $name = NULL, $quantity = NULL, $price = NULL, $commande_id = NULL)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getCommandeId()
    {
        return $this->commande_id;
    }

    public function setCommandeId($commande_id)
    {
        $this->commande_id = $commande_id;
    }
}