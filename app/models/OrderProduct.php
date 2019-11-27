<?php

namespace app\models;

class OrderProduct
{

    private $connect;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function create($data)
    {
        $query = "INSERT INTO order_products(order_id, product_id, quantity, created_at) SET order_id=:order_id, product_id=:product_id, quantity=:quantity, created_at=now()";
        $statement = $this->connect->prepare($query);
        $statement->bindParam(':order_id', $data['order_id']);
        $statement->bindParam(':product_id', $data['product_id']);
        $statement->bindParam(':quantity', $data['quantity']);

        if ($statement->execute()) {
            return true;
        }

        return false;
    }

    public function selectAll()
    { }

    public function show($id)
    { }

    public function update($data)
    { }

    public function delete($dd)
    { }

    public function search($data)
    { }
}
