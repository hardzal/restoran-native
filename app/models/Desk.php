<?php

namespace app\models;
use PDO;
class Desk {
    
    private $connect;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function selectAll() {
        $query = "SELECT d.id, d.name_desk, d.status_desk, d.type_id, dt.type_name FROM desks d 
            INNER JOIN desk_types dt ON d.type_id=dt.id ORDER BY d.status_desk ASC";

        $stmt = $this->connect->prepare($query);

        if($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function show($id) {
        $query = "SELECT d.name_desk, d.status_desk, d.type_id, dt.type_name, d.description FROM desks d 
        INNER JOIN desk_types dt ON d.type_id=dt.id WHERE d.id = :id";

        $statement = $this->connect->prepare($query);

        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $statement->bindParam(':id', $id);

        if($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function create() {
        $query = "";
    }

    public function update() {
        $query = "";
    }

    public function delete() {
        $query = "";
    }

    public function search() {
        
    }
}

?>