<?php

class Commande{
    protected $conn;
    protected $id;
    protected $titre;
    protected $address;
    protected $phone;
    protected $statu;
    protected $created_at;
    protected $is_deleted;

    function __construct($conn = NULL, $id = NULL, $titre = NULL, $address = NULL, $phone = NULL, $statu = "pending", $created_at = NULL, $is_deleted = 0)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->titre = $titre;
        $this->address = $address;
        $this->statu = $statu;
        $this->created_at = $created_at;
        $this->is_deleted = $is_deleted;
        $this->phone = $phone;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitre()
    {
        return $this->titre;
    }
    
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getStatu()
    {
        return $this->statu;
    }

    public function setStatu($statu)
    {
        $this->statu = $statu;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getIs_deleted()
    {
        return $this->is_deleted;
    }

    public function setIs_deleted($is_deleted)
    {
        $this->is_deleted = $is_deleted;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
}