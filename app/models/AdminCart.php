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
        $sql = 'SELECT sum(p.price * c.quantity) as cost, sum(c.discount) as discount, sum(c.send) as send, c.date as date, c.user_id as user_id 
                FROM carts as c, products as p
                WHERE c.product_id=p.id
                AND c.state=1
                GROUP BY date(c.date), c.user_id';
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function show($date, $id)
    {
        $sql = 'SELECT p.price as price, c.quantity as quantity, c.discount as discount, c.send as send, p.name as name
                FROM carts as c, products as p 
                WHERE c.product_id = p.id
                AND c.user_id = :user_id
                AND c.state = 1
                AND DATE(date) = :date';
        $query = $this->db->prepare($sql);
        $params = [
            ':user_id' => $id,
            ':date' => $date,
        ];
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}