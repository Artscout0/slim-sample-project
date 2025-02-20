<?php

namespace Slicettes\Utils;

use PDO;
use PDOException;

class PDOSingleton
{
    private static $instance = null;
    private PDO $pdo;

    private $host = 'localhost';
    private $db = 'Slicettes';
    private $user = 'slicettes_user';
    private $pass = 'slicettes_password';
    private $charset = 'utf8mb4';

    private function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Errors cause exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Results as associative arrays unless told otherwise
            PDO::ATTR_EMULATE_PREPARES => false, // IDK but seems important
        ];
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // prevent unwanted stuff
    private function __clone() {}
    public function __wakeup() {}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
