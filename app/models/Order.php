<?php

namespace app\models;
use PDO;

class Order {
    
    private $connect;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function selectAll() {
        $query = "SELECT ud.full_name AS name, d.name_desk, o.description, o.status_order, o.created_at, o.updated_at FROM orders o INNER JOIN users u on o.user_id=u.id INNER JOIN user_details ud on u.id=ud.user_id INNER JOIN desks d ON o.desk_id=d.id ORDER BY o.status_order ASC, o.created_at DESC";

        $statement = $this->connect->prepare($query);

        if($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } 

        return false;
    }

    public function show() {
        
    }

    public function delete() {

    }

    public function update() {
        
    }

    public function search() {

    }
}

?>