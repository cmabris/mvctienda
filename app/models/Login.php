<?php

class Login
{
    private $db;

    public function __construct()
    {
        $this->db = MySQLdb::getInstance()->getDatabase();
    }

    public function existsEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email=:email';
        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        return $query->rowCount();
    }

    public function createUser($data)
    {
        if ( ! $this->existsEmail($data['email'])) {
            //Si no existe se inserta
        } else {
            //Si ya existe, no hace nada
        }
    }
}