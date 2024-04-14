<?php

namespace Mdeveloper1002\Mframework\Database;

use PDO;
use PDOException;

class Connection
{
    private static ?Connection $instance = null;
    private $conn;
    private $host;
    private $user;
    private $pass;
    private $name;

    private function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->pass = $_ENV['DB_PASS'];
        $this->name = $_ENV['DB_NAME'];

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->name}", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            //echo "Connection failed: " . $e->getMessage();
            echo "Connection failed: Database connection failed. Please check your database configuration in the .env file.";
        }
    }

    // The object is created and the connection is established in the getInstance method.
    public static function getInstance(): ?Connection
    {
        if (!self::$instance) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    // The connection is returned in the getConnection method.
    public function getConnection(): PDO
    {
        return $this->conn;
    }

    // The object is cloned and the connection is established in the __clone method.
    private function __clone()
    {
    }
}