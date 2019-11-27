<?php

namespace app\config;

use \app\config\Database as Database;
use PDO;

class Authentication extends Database {

    private $connect;
    
    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function checkRole($role) {
        $query = "SELECT * FROM user_roles WHERE id = :role";

        $stmt = $this->connect->prepare($query);
    
        $stmt->bindParam(':role', $role);

        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result['id'] == 6) {
                header('Location: ./?show=user&pages=index');
            } else if($result['id'] != 7) {
                header('Location: ./?show=admin&pages=index');
            }
        }
        return false;
    }

    public function login() {
        // $validated = false;

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // $validate = new Validation();
        // $validated = $validate->checkField([$username, $password]);

        // if($validated) {
        $query = "SELECT id, username, password, email, roles_id FROM users WHERE username = :username OR email = :email";

        $stmt = $this->connect->prepare($query);

        $params = array(
            ':username' => $username,
            ':email' => $email
        );

        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result) {
            if(password_verify($password, $result['password'])) {             
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['roles_id'] = $result['roles_id'];
                return true;
            }
        } 

        return false;
    }

    public function register() {

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $password_confirm = filter_input(INPUT_POST, 'password_confirm', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if($password == $password_confirm) {
            $query = "SELECT * FROM users WHERE username = :username";

            $check = $this->connect->prepare($query);
            $check->bindParam(':username', $username);
            $check->execute();

            if($check->rowCount() == 0) {
                $query = "INSERT INTO users(username, password, email, roles_id) VALUES(:username, :password, :email, :roles_id)";

                $options = [
                    'cost' => 12
                ];
            
                $password = password_hash($password, PASSWORD_BCRYPT, $options);

                $params = array(
                    ':username' => $username,
                    ':password' => $password,
                    ':email' => $email,
                    ':roles_id' => 6
                );

                $stmt = $this->connect->prepare($query);
                $stmt->execute($params);

                return true;
            } 
        } 
        return false; 
    }

    public function logout() {
        if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
            unset($_SESSION['roles_id']);
            unset($_SESSION['username']);
            unset($_SESSION['cart']);
            return true;
        }
    }

    public function checkSesi() {
        if(!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) {
            return false;
        }
        return true;
    }

    public function redirected() {
        header('Location: ./?show=index');
    }
}
