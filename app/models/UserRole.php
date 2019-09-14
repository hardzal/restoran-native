<?php

namespace app\models;
use PDO;
class UserRole {
    
    private $connect;
    
    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function selectAll() {
        $query = "SELECT * FROM user_roles";

        $statement = $this->connect->prepare($query);

        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function show($id) {

    }

    public function create() {

    }

    public function update($id) {

    }

    public function delete($id) {

    }
    
    public function search() {

    }
}