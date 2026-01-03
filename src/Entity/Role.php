<?php

class Role{
    protected $id;
    protected $name;
    protected $user_id;

    function __construct($id = NULL, $name = NULL, $user_id = NULL)
    {
        $this->id = $id;
        $this->name = $name;
        $this->user_id = $user_id;
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

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }
}