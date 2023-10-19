<?php

class AdminCart
{
    private $db;

    public function __construct()
    {
        $this->db = MySQLdb::getInstance()->getDatabase();
    }

    public function sales()
    {
        $data = [];
        return $data;
    }
}