<?php

namespace app\models;
use PDO;

class Category {
    private $connect;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function selectAll() { 
        $query = "SELECT * FROM categories";

        $statement = $this->connect->prepare($query);

        if($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function show($id) {
        $query = "SELECT name, description FROM categories WHERE id = :id";

        $statement = $this->connect->prepare($query);

        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $statement->bindParam(':id', $id);

        if($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }   
    
    public function create() {
        $query = "INSERT INTO categories(name, description) VALUES(:name, :description)";

        $statement = $this->connect->prepare($query);

        $name = filter_var($this->filterString($_POST['name']), FILTER_SANITIZE_STRING);
        $description = filter_var($this->filterString($_POST['description']), FILTER_SANITIZE_STRING);

        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $description);

        if($statement->execute()) {
            return true;
        }

        return false;
    }

    public function update($id) {
        $query = "UPDATE categories SET name = :name, description = :description, updated_at = 'now()' WHERE id = :id";

        $statement = $this->connect->prepare($query);

        $name = filter_var($this->filterString($_POST['title']), FILTER_SANITIZE_STRING);
        $description = filter_var($this->filterString($_POST['description']), FILTER_SANITIZE_STRING);
        $id = filter_var($this->filterString($id), FILTER_SANITIZE_NUMBER_INT);

        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':id', $id);
    
        if($statement->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM categories WHERE id = :id";

        $statement = $this->connect->prepare($query);

        $id = filter_var($this->filterString($id), FILTER_SANITIZE_STRING);
        
        $statement->bindParam(':id', $id);

        if($statement->execute()) {
            return true;
        }

        return false;
    }

    public function search($column) {
        $value = $this->filterString($_POST['search']);

        $query = "SELECT name, description FROM categories WHERE $column LIKE '%$value%' ORDER BY p.created_at DESC";

        $statement = $this->connect->prepare($query);

        if($statement->execute()) {
            if($statement->rowCount() > 0) {
                return $statement->fetchAll(PDO::FETCH_ASSOC); 
            } 
        }

        return false;
    }

    public function filterString($variabel) {
        return htmlentities(strip_tags($variabel));
    }
}

?>