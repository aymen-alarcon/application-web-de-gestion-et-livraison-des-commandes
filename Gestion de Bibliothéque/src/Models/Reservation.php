<?php

class Reservation{
    private ?int $id;
    private ?string $date_reservation;

    public function __construct($id = NULL, $date_reservation = NULL)
    {
        $this->id = $id;
        $this->date_reservation = $date_reservation;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDate_reservation()
    {
        return $this->date_reservation;
    }

    public function setDate_reservation($date_reservation)
    {
        $this->date_reservation = $date_reservation;
    }
}