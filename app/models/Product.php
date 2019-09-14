<?php

namespace app\models;

use \app\config\Utilities as Utilities;
use PDO;

class Product {
    
    private $connect;
    public static $message = '';

    public $id;
    public $category_id;
    public $name;
    public $price;
    public $stock;
    public $img_product;
    public $status_product;
    public $description;
    public $created_at;
    public $updated_at;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function filterString($variabel) {
        return htmlspecialchars(strip_tags($variabel));
    }

    public function selectAll() {
        /*
            nama, harga, stock, image, category
        */
        $query = "SELECT p.id, p.name, p.price, p.stock, p.status_product, c.name AS \"category_name\", p.img_product, p.description
                    FROM products p INNER JOIN categories c ON p.category_id=c.id WHERE p.status_product = 1
                    ORDER BY p.created_at DESC
                ";

        $statement = $this->connect->prepare($query);

        if($statement->execute()) {
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } 

        return false;
    }

    public function show($id) {
        $query = "SELECT p.name, p.category_id, p.price, p.stock, p.status_product, c.name AS \"category_name\", p.img_product, p.description
                FROM products p INNER JOIN categories c ON p.category_id=c.id
                WHERE p.id= :id
                ";

        $statement = $this->connect->prepare($query);
        
        $id = $this->filterString($id);

        $statement->bindParam(':id', $id);
        
        if($statement->execute()) {
            return $statement->fetch(\PDO::FETCH_ASSOC);
        } 

        return false;
    }

    public function create() {
        $query = "INSERT INTO products
                    VALUES('', ?, ?, ?, ?, ?, ?, ?, now(), '')";

        $stmt = $this->connect->prepare($query);
        
        $category_id = filter_var($this->filterString($_POST['category_id']), FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($this->filterString($_POST['title']), FILTER_SANITIZE_STRING);
        $price = filter_var($this->filterString($_POST['price']), FILTER_SANITIZE_NUMBER_INT);
        $stock = filter_var($this->filterString($_POST['stock']), FILTER_SANITIZE_NUMBER_INT);
        $description = filter_var($this->filterString($_POST['description']), FILTER_SANITIZE_STRING);
        $status_produk = filter_var($this->filterString($_POST['status_product']), FILTER_SANITIZE_NUMBER_INT);

        $utilities = new Utilities();
        if(isset($_FILES['img'])) {
            $utilities->upload($_FILES['img']);
            $img_product = $utilities->getFileName();
        } else {
            $img_product = 'food_default.png';
        }

        $stmt->bindParam(1, $category_id);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $price);
        $stmt->bindParam(4, $stock);
        $stmt->bindParam(5, $img_product);
        $stmt->bindParam(7, $description);
        $stmt->bindParam(6, $status_produk);

        if($stmt->execute()) {
            return true;
        } 

        return false;
    }

    public function update($id) {
        if(isset($_FILES['img']) && !empty($_FILES['img'])) {
            $query = "UPDATE products 
                    SET
                        name = :name,
                        category_id = :category_id,
                        price = :price,
                        stock = :stock,
                        img_product = :img_product,
                        status_product = :status_product,
                        description = :description,
                        updated_at = now()
                    WHERE id = :id
                ";

            $utilities = new Utilities();
            $utilities->upload($_FILES['img']);
            $img_product = $utilities->getFileName();            
        } else {
            $query = "UPDATE products 
                    SET
                        name = :name,
                        category_id = :category_id,
                        price = :price,
                        stock = :stock,
                        status_product = :status_product,
                        description = :description,
                        updated_at = now()
                    WHERE id = :id
                ";
        }

        $statement = $this->connect->prepare($query);
        
        $id = $this->filterString($id);
        $statement = $this->connect->prepare($query);

        $category_id = $this->filterString($_POST['category_id']);
        $name = $this->filterString($_POST['title']);
        $price = $this->filterString($_POST['price']);
        $stock = $this->filterString($_POST['stock']);

        $description = $this->filterString($_POST['description']);
        $status_product = $this->filterString($_POST['status_product']);

        $statement->bindParam(':id', $id);
        $statement->bindParam(':category_id', $category_id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':stock', $stock);
        
        if(isset($_FILES['img'])) {
            $statement->bindParam(':img_product', $img_product);
        }
        $statement->bindParam(':description', $description);
        $statement->bindParam(':status_product', $status_product);

        if($statement->execute()) {
            return true;
        } 

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM products WHERE id= :id";

        $statement = $this->connect->prepare($query);
        
        $id = $this->filterString($id);

        $statement->bindParam(':id', $id);
        
        if($statement->execute()) {
            return true;
        } 
        return false;
    }

    public function search($column) {
        // $value = $this->filterString($_POST['search']);
        $value = $column;
        $query = "SELECT p.name, p.price, p.stock, p.status_product, c.name AS \"category_name\", p.img_product, p.description
        FROM products p INNER JOIN categories c ON p.category_id=c.id WHERE p.name LIKE '%$value%' ORDER BY p.created_at DESC";

        $statement = $this->connect->prepare($query);

        if($statement->execute()) {
            if($statement->rowCount() > 0) {
                return $statement->fetchAll(\PDO::FETCH_ASSOC); 
            } 
        }

        return false;
    }

    public function showByCategory($id) {
        $query = "SELECT p.id, p.name, p.price, p.stock, p.status_product, c.name AS \"category_name\", p.img_product, p.description
        FROM products p INNER JOIN categories c ON p.category_id=c.id WHERE p.status_product = 1 AND p.category_id = :id ORDER BY p.created_at DESC
    ";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':id', $id);

        if($statement->execute()) {
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } 

        return false;
    }
}