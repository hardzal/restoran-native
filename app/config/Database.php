<?php

namespace app\config;

class Database {    
    private $connect;
    private $db_host        = "localhost";
    private $db_username    = "root";
    private $db_password    = "";
    private $db_name        = "praktikum_basdat_restoran";
    private $db_attribute   = [
        \PDO::ATTR_ERRMODE               => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE    => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES      => false
    ];

    public function __construct()
    {
        $this->connect = null;
    }

    public function getConnection() {
        try {
            $this->connect = new \PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_username, $this->db_password, $this->db_attribute);
        } catch (\PDOException $er) {
            echo "Connection error : ". $er->getMessage(). "<br>";
        }

        return $this->connect;
    }

}

?>