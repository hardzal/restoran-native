<?php

namespace app\models;

use PDO;
class User {
    
    private $connect;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function selectAll() {
        $query = "SELECT u.id, u.username, u.email, u.roles_id, ur.roles, ud.full_name, ud.gender 
        FROM users AS u 
        LEFT JOIN user_details AS ud ON u.id=ud.user_id
        LEFT JOIN user_roles AS ur ON u.roles_id=ur.id
        ORDER BY u.created_at DESC";

        $statement = $this->connect->prepare($query);

        if($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function show($id) {
        $query = "SELECT u.id, u.username, u.email, u.roles_id, ur.roles, ud.full_name, ud.gender, ud.address, ud.avatar
        FROM users AS u 
        LEFT JOIN user_details AS ud ON u.id=ud.user_id
        LEFT JOIN user_roles AS ur ON u.roles_id=ur.id
        WHERE u.id = :id";

        $statement = $this->connect->prepare($query);

        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $statement->bindParam(':id', $id);

        if($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function update($id) {
        print_r($_POST);
        $query = "UPDATE users SET username=:username, email=:email, roles_id=:roles_id WHERE id=:id";

        if(isset($_POST['password']) && !empty($_POST['password'])) {
            $query = "UPDATE users SET username=:username, password=:password, email=:email, roles_id=:roles_id WHERE id=:id";
        }    
        $statement = $this->connect->prepare($query);

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $roles_id = filter_input(INPUT_POST, 'roles', FILTER_SANITIZE_NUMBER_INT);
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        // $password_confirm = filter_input(INPUT_POST, 'password_confirm', FILTER_SANITIZE_STRING);
    
        // $statement->bindParam(':password', $password);
        // $statement->bindParam(':passwod_confirm', $password_confirm);
        if(isset($_POST['password']) && !empty($_POST['password'])) {
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $options = [
                'cost' => 12
            ];
            $password_new = password_hash($password, PASSWORD_BCRYPT, $options);

            $statement->bindParam(':password', $password_new);
        }

        
        $statement->bindParam(':username', $username);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':roles_id', $roles_id);
        $statement->bindParam(':id', $id);

        if($statement->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id = :id";

        $statement = $this->connect->prepare($query);
        
        $statement->bindParam(':id', $id);

        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if($statement->execute()) {
            return true;
        }

        return false;
    }

    public function search() {
        $query = "SELECT";
    }

    public function filterString($var) {
        return htmlspecialchars(strip_tags($var));
    }
}

?>