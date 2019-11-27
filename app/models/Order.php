<?php

namespace app\models;

use PDO;

class Order
{

    private $connect;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function selectAll()
    {
        $query = "SELECT ud.full_name AS name, d.name_desk, o.created_at, o.updated_at FROM orders o INNER JOIN users u on o.user_id=u.id INNER JOIN user_details ud on u.id=ud.user_id INNER JOIN desks d ON o.desk_id=d.id ORDER BY o.created_at DESC";

        $statement = $this->connect->prepare($query);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function create($data)
    {
        $query = "INSERT INTO orders(user_id, desk_id, created_at) SET user_id=:user_id, desk_id=:desk_id, created_at=now()";

        $statement = $this->connect->prepare($query);
        $statement->bindParam(':user_id', $data['user_id']);
        $statement->bindParam(':desk_id', $data['desk_id']);

        if ($statement->execute()) {
            return true;
        }

        return false;
    }

    public function show($id)
    {
        $query = "";

        $statement = $this->connect->prepare($query);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function delete()
    { }

    public function update()
    { }

    public function search()
    { }
}
